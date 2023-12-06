@extends('template.home')
@section('heading', 'Monitoring Harian')
@section('page')
  <li class="breadcrumb-item active">Data Monitoring</li>
  <li class="breadcrumb-item active">Monitoring Harian</li>
@endsection
@section('content')
<?php
if (count($pertanyaan) > 0) {
    $disable_simpan = "";
} else {
    $disable_simpan = " disabled";
}

$ftanggal_epoch = strtotime($ftanggal);
$today_epoch = strtotime(date("Y-m-d")." 00:00:00");
if ($ftanggal_epoch > $today_epoch) {
    $disable_future = " disabled";
} else {
    $disable_future = "";
}

?>

<div class="col-md-12">
    <form action="{{ route('monitoring.harian.simpan_jawaban') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Isi Monitoring Harian</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @if (count($list_siswa) > 1)
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="filter_siswa">Pilih Siswa</label>
                        <select id="filter_siswa" name="filter_siswa" class="select2bs4 form-control">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($list_siswa as $v)
                                    <?php $sel = $v->id == $fsiswa ? " selected" : ""; ?>
                                    <?php if ($v->id == $fsiswa) $has_siswa = true; ?>
                                    <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->nama }} ({{ $v->nis }})</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if (isset($siswa))
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="filter_tanggal">Tanggal</label>
                        <input type="date" id="filter_tanggal" name="filter_tanggal" value="{{ $ftanggal }}" class="form-control @error('filter_tanggal') is-invalid @enderror" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="lihat_kalender">&nbsp;</label>
                        <a href="{{ route('monitoring.harian.orang_tua.calendar', urlencode(Crypt::encrypt($siswa->id))).'?tahun='.$tahun.'&bulan='.$bulan }}">
                            <button type="button" id="lihat_kalender" class="btn btn-primary form-control">Lihat Kalender</button>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
            @if ($siswa)
                <div class="col-md" style="margin-bottom: 10px;">
                    <div class="card-header">
                        <?php $kelas = $siswa->kelas(); ?>
                        <?php $wali_kelas = $kelas->wali_kelas(); ?>
                        <h5 class="card-title card-text mb-2">NIS : {{ $siswa->nis }}</h5>
                        <h5 class="card-title card-text mb-2">Nama Siswa : {{ $siswa->nama }}</h5>
                        <h5 class="card-title card-text mb-2">Kelas : {{ $kelas->tingkatan.$kelas->nama }}</h5>
                        <h5 class="card-title card-text mb-2">Wali Kelas : {{ "{$wali_kelas->nama}" }}</h5>
                    </div>
                    @if (isset($allow_edit) && $allow_edit)
                    <div class="card-header">
                        <h3 class="card-title">
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                                <i class="nav-icon fas fa-folder-plus"></i> &nbsp; {{ $add_title }}
                            </button>
                        </h3>
                    </div>
                    @endif
                </div>
            @endif
            </div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Monitoring untuk tanggal {{ fix_id_d($ftanggal) }}</h3>
            <input type="hidden" name="id_siswa" value="{{ $fsiswa }}"/>
            <input type="hidden" name="tanggal" value="{{ $ftanggal }}"/>
        </div>
        <div class="card-body">
            <div>
                @if (count($pertanyaan) > 0)
                    @foreach ($pertanyaan as $k => $p)
                        <?php $i = $loop->iteration; ?>
                        <?php $id = $p->id; ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pertanyaan_{{ $i }}">Pertanyaan {{ $i }}</label>
                                    <textarea disabled="true" class="form-control @error('pertanyaan_'.$i) is-invalid @enderror" name="pertanyaan[{{ $id }}]" id="pertanyaan_{{ $i }}">{{ $p->pertanyaan }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jawaban_{{ $i }}">Jawaban {{ $i }}</label>
                                    @if ($p->tipe === "opsi")
                                    <?php
                                        $y_check = "";
                                        $n_check = "";

                                        if (isset($jawaban[$k]->jawaban)) {
                                            if ($jawaban[$k]->jawaban === "ya") {
                                                $y_check = " checked";
                                            } else {
                                                $n_check = " checked";
                                            }
                                        }
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="jawaban_y_{{ $i }}" name="jawaban[{{ $id }}]" value="ya"{!! $y_check !!}{!! $disable_future !!}>
                                        <label class="form-check-label" for="jawaban_y_{{ $i }}">
                                        Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="jawaban_n_{{ $i }}" name="jawaban[{{ $id }}]" value="tidak"{!! $n_check !!}{!! $disable_future !!}>
                                        <label class="form-check-label" for="jawaban_n_{{ $i }}">
                                        Tidak
                                        </label>
                                    </div>
                                    @elseif ($p->tipe === "isian")
                                        <textarea class="form-control @error('jawaban_'.$i) is-invalid @enderror" name="jawaban[{{ $id }}]" id="pertanyaan_{{ $i }}"{!! $disable_future !!}>{{ $jawaban[$k]->jawaban ?? "" }}</textarea>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>
                        <h1>Monitoring belum tersedia!</h1>
                    </div>
                @endif
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('monitoring.harian.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <button name="submit" class="btn btn-primary"{!! $disable_simpan !!}{!! $disable_future !!}><i class="nav-icon fas fa-save"></i> &nbsp; Simpan Jawaban</button>
        </div>
    </div>
    </form>
</div>

@endsection
@section('script')
<script>
    $("#Monitoring").addClass("active");
    $("#liMonitoring").addClass("menu-open");
    $("#DataMonitoringHarian").addClass("active");
    let fsiswa = $("#filter_siswa");
    let ftanggal = $("#filter_tanggal");

    function handle_filter()
    {
        let url = "";

        url += "?fsiswa=" + fsiswa.val();
        @if ($siswa)
        url += "&ftanggal=" + ftanggal.val();
        @endif
        window.location = url;
    }

    fsiswa.change(handle_filter);
    @if ($siswa)
    ftanggal.change(handle_filter);
    @endif
</script>
@endsection

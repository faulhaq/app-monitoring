@extends('template.home')
@section('heading', 'Monitoring Harian')
@section('page')
  <li class="breadcrumb-item active">Data Monitoring</li>
  <li class="breadcrumb-item active">Monitoring Harian</li>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Monitoring Harian</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fkelas">Pilih Kelas</label>
                        <select id="fkelas" name="fkelas" class="select2bs4 form-control">
                            @if (count($list_kelas) > 1)
                                <option value="">-- Pilih Kelas --</option>
                            @endif
                            @foreach ($list_kelas as $v)
                                <?php $ta = $v->tahun_ajaran(); ?>
                                @if ($ta->id == $id_tahun_ajaran_aktif)
                                <?php $sel = $v->id == $fkelas ? " selected" : ""; ?>
                                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->tingkatan.$v->nama." (TA: {$ta->tahun})" }} (aktif)</option>
                                @endif
                            @endforeach
                            @foreach ($list_kelas as $v)
                                <?php $ta = $v->tahun_ajaran(); ?>
                                @if ($ta->id != $id_tahun_ajaran_aktif)
                                <?php $sel = $v->id == $fkelas ? " selected" : ""; ?>
                                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->tingkatan.$v->nama." (TA: {$ta->tahun})" }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @if (!empty($fkelas))
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fsiswa">Pilih Siswa</label>
                        <select id="fsiswa" name="fsiswa" class="select2bs4 form-control">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($list_siswa as $v)
                                <?php $sel = $v->id == $fsiswa ? " selected" : ""; ?>
                                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->nama }} ({{ $v->nis }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if (!empty($fsiswa))
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ftanggal">Pilih Tanggal</label>
                        <input type="date" id="ftanggal" name="ftanggal" value="{{ $ftanggal }}" class="form-control @error('ftanggal') is-invalid @enderror">
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
            @if (isset($siswa))
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

    @if (!empty($fsiswa))
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Monitoring untuk tanggal {{ fix_id_d($ftanggal) }}</h3>
            <input type="hidden" name="id_siswa" value="{{ $fsiswa }}"/>
            <input type="hidden" name="tanggal" value="{{ $ftanggal }}"/>
        </div>
        <div class="card-body">
            @if (count($pertanyaan) > 0)
            <div>
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
                                    <input class="form-check-input" type="radio" id="jawaban_y_{{ $i }}" name="jawaban[{{ $id }}]" value="ya"{!! $y_check !!} disabled="true">
                                    <label class="form-check-label" for="jawaban_y_{{ $i }}">
                                    Ya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jawaban_n_{{ $i }}" name="jawaban[{{ $id }}]" value="tidak"{!! $n_check !!} disabled="true">
                                    <label class="form-check-label" for="jawaban_n_{{ $i }}">
                                    Tidak
                                    </label>
                                </div>
                                @elseif ($p->tipe === "isian")
                                    <textarea class="form-control @error('jawaban_'.$i) is-invalid @enderror" name="jawaban[{{ $id }}]" id="pertanyaan_{{ $i }}" disabled="true">{{ $jawaban[$k]->jawaban ?? "" }}</textarea>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <div>
                <h1>Monitoring belum tersedia!</h1>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('monitoring.harian.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
        </div>
    </div>
    @endif
</div>

@endsection
@section('script')
<script>
    $("#Monitoring").addClass("active");
    $("#liMonitoring").addClass("menu-open");
    $("#DataMonitoringHarian").addClass("active");
    let fkelas = $("#fkelas");
    let fsiswa = $("#fsiswa");
    let ftanggal = $("#ftanggal");

    function handle_filter()
    {
        let url = "";

        url += "?fkelas=" + fkelas.val();

        if (fsiswa.val())
            url += "&fsiswa=" + fsiswa.val();

        if (ftanggal.val())
            url += "&ftanggal=" + ftanggal.val();

        window.location = url;
    }

    fkelas.change(function () {
        fsiswa.val("");
        handle_filter();
    });
    fsiswa.change(handle_filter);
    ftanggal.change(handle_filter);
</script>
@endsection

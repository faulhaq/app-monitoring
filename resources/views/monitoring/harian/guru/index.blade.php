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
                <div class="col-md-3">
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
                <div class="col-md-3">
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
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ftanggal">Pilih Tanggal</label>
                        <input type="date" id="ftanggal" name="ftanggal" value="{{ $ftanggal }}" class="form-control @error('ftanggal') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="lihat_kalender">&nbsp;</label>
                        <a href="{{ route('monitoring.harian.orang_tua.calendar', urlencode(Crypt::encrypt($siswa->id))).'?tahun='.$tahun.'&bulan='.$bulan.'&kelas='.$fkelas }}">
                            <button type="button" id="lihat_kalender" class="btn btn-primary form-control">Lihat Kalender</button>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
            @if (isset($siswa))
                <div class="col-md" style="margin-bottom: 10px;">
                    <div class="card-body">
                        <?php $kelas = $siswa->kelas(); ?>
                        <?php $wali_kelas = $kelas->wali_kelas(); ?>
                        <h5 class="card-title card-text mb-2">NIS : {{ $siswa->nis }}</h5>
                        <h5 class="card-title card-text mb-2">Nama Siswa : {{ $siswa->nama }}</h5>
                        <h5 class="card-title card-text mb-2">Kelas : {{ $kelas->tingkatan.$kelas->nama }}</h5>
                        <h5 class="card-title card-text mb-2">Wali Kelas : {{ "{$wali_kelas->nama}" }}</h5>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>

    @if (!empty($fsiswa))
    <form action="{{ route('monitoring.harian.terima_jawaban').'?id_siswa='.$siswa->id.'&tanggal='.$ftanggal }}" method="POST">
        @csrf
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Monitoring untuk tanggal {{ fix_id_d($ftanggal) }}</h3>
                <input type="hidden" name="id_siswa" value="{{ $fsiswa }}"/>
                <input type="hidden" name="tanggal" value="{{ $ftanggal }}"/>
            </div>
            <div class="card-body">
                @if (count($pertanyaan) > 0)
                <div>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr><th>No.</th><th>Pertanyaan</th><th>Jawaban</th></tr>
                        </thead>
                        <tbody>
                        <?php
                            $nr_dijawab = 0;
                            $nr_pertanyaan = 0;
                        ?>
                        @foreach ($pertanyaan as $k => $p)
                            <?php $nr_pertanyaan++; ?>
                            <tr>
                            <?php $i = $loop->iteration; ?>
                            <?php $id = $p->id; ?>
                            <?php
                                if (isset($jawaban[$k]->jawaban)) {
                                    $nr_dijawab++;
                                }
                            ?>
                            <td>{{ $i }}</td>
                            <td>
                                <p>{{ $p->pertanyaan }}</p>
                            </td>
                            <td>
                                <p>{{ ucfirst($jawaban[$k]->jawaban ?? "") }}</p>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-4">
                        <table class="table">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td>Total Pertanyaan</td>
                                    <td>:</td>
                                    <td>{{ $nr_pertanyaan }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah dijawab</td>
                                    <td>:</td>
                                    <td>{{ $nr_dijawab }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah tidak dijawab</td>
                                    <td>:</td>
                                    <td>{{ $nr_pertanyaan - $nr_dijawab }}</td>
                                </tr>
                                <tr>
                                    <td>Point</td>
                                    <td>:</td>
                                    <td>
                                        @if ($jawaban_terkunci !== false)
                                            {{ $jawaban_terkunci }}
                                        @else
                                            <input type="number" name="point"/>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p>Catatan: Jika tombol "Simpan" ditekan, maka orang tua tidak dapat mengubah jawaban dan point akan ditampilkan di sisi orang tua.</p>
                    </div>
                </div>
                @else
                <div>
                    <h1>Monitoring belum tersedia!</h1>
                </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('monitoring.harian.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
                @if ($jawaban_terkunci !== false)
                    <button type="button" class="btn btn-primary" disabled="true">Jawaban sudah terkunci</button>
                @else
                    <button type="submit" class="btn btn-primary">Simpan</button>
                @endif
            </div>
        </div>
    </form>
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

@extends('template.home')
@section('heading', 'Kalender Monitoring Harian')
@section('page')
  <li class="breadcrumb-item active">Data Monitoring</li>
  <li class="breadcrumb-item active">Kalender Monitoring Harian</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Kalender</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md" style="margin-bottom: 10px;">
                    <?php $kelas = $siswa->kelas(); ?>
                    <?php $wali_kelas = $kelas->wali_kelas(); ?>
                    <h5 class="card-title card-text mb-2">NIS : {{ $siswa->nis }}</h5>
                    <h5 class="card-title card-text mb-2">Nama Siswa : {{ $siswa->nama }}</h5>
                    <h5 class="card-title card-text mb-2">Kelas : {{ $kelas->tingkatan.$kelas->nama }}</h5>
                    <h5 class="card-title card-text mb-2">Wali Kelas : {{ "{$wali_kelas->nama}" }}</h5>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr><th>No.</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    @foreach ($list_tanggal as $tg => $v)
                        <?php
                            if ($v) {
                                $v = "<b style=\"color: green;\">Sudah Terisi</b>";
                            } else {
                                $v = "<b style=\"color: red;\">Belum Terisi</b>";
                            }
                        ?>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ fix_id_d($tg) }}</td>
                            <td>{!! $v !!}</td>
                            <td>
                                <a href="{{ route('monitoring.harian.index2').'?fsiswa='.$siswa->id.'&ftanggal='.$tg }}">
                                    <button class="btn btn-primary">Lihat Laporan</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('monitoring.harian.index2').'?fsiswa='.$siswa->id }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
</script>
@endsection

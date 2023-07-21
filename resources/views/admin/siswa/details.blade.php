@extends('template_backend.home')
@section('heading', 'Details Siswa')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></li>
  <li class="breadcrumb-item active">Details Siswa</li>
@endsection
@section('content')
@include('admin.siswa.backlink')
<?php generate_back_link($orang_tua, $back_link); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-4">
                    <img src="{{ asset($siswa->foto) }}" class="card-img img-details" alt="...">
                </div>
                <div class="col-md-1 mb-4"></div>
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">Nama : {{ $siswa->nama }}</h5>
                    <h5 class="card-title card-text mb-2">NIK : {{ $siswa->nik }}</h5>
                    <h5 class="card-title card-text mb-2">NIS : {{ $siswa->nis }}</h5>
                    <h5 class="card-title card-text mb-2">Kelas : {{ $siswa->kelas->nama_kelas }}</h5>
                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $siswa->telp }}</h5>
                    @if ($siswa->jk == 'L')
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Laki-laki</h5>
                    @else
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Perempuan</h5>
                    @endif
                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $siswa->tmp_lahir }}</h5>
                    <h5 class="card-title card-text mb-2">Tanggal Lahir : {{ date('l, d F Y', strtotime($siswa->tgl_lahir)) }}</h5>
                    <h5 class="card-title card-text mb-2">Agama : {{ $siswa->agama }}</h5>
                    <h5 class="card-title card-text mb-2">Golongan Darah : {{ $siswa->goldar }}</h5>
                    <h5 class="card-title card-text mb-2">Alamat : {{ $siswa->alamat }}</h5>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ $back_link }}" class="btn btn-default btn-sm"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
        </div>
    </div>
</div>
@endsection
@section('script')
@if ($orang_tua)
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataOrangTua").addClass("active");
</script>
@else
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataSiswa").addClass("active");
</script>
@endif
@endsection
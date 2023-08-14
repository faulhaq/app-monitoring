@extends('template.home')
@section('heading', 'Details Orang Tua')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Orang Tua</a></li>
  <li class="breadcrumb-item active">Details Orang Tua</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-4">
                    @if ($siswa->foto)
                        <img src="{{ asset('uploads/siswa/'.$siswa->foto) }}" class="card-img img-details" alt="{{ $siswa->nama }}">
                    @else
                        <h3>Tidak ada foto</h3>
                    @endif
                </div>
                <div class="col-md-1 mb-4"></div>
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">No. KK : {{ $siswa->kk()->no_kk }}</h5>
                    <h5 class="card-title card-text mb-2">NIK : {{ $siswa->nik }}</h5>
                    <h5 class="card-title card-text mb-2">NIS : {{ $siswa->nis }}</h5>
                    <h5 class="card-title card-text mb-2">Nama : {{ $siswa->nama }}</h5>
                    <h5 class="card-title card-text mb-2">Jenis Kelamin : {{ $siswa->jk === "L" ? "Laki-laki" : "Perempuan" }}</h5>
                    <h5 class="card-title card-text mb-2">Agama : {{ $siswa->agama() }}</h5>
                    <h5 class="card-title card-text mb-2">Goldar : {{ $siswa->goldar() }}</h5>
                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $siswa->telp }}</h5>
                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $siswa->tmp_lahir }}</h5>
                    <h5 class="card-title card-text mb-2">Tanggal Lahir : {{ date('l, d F Y', strtotime($siswa->tgl_lahir)) }}</h5>
                    <h5 class="card-title card-text mb-2">Alamat : {{ $siswa->alamat }}</h5>
                    <h5 class="card-title card-text mb-2">Status : {{ $siswa->status() }}</h5> 
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('siswa.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <?php $enc_id = Crypt::encrypt($siswa->id); ?>
            <a href="{{ route('siswa.edit', $enc_id) }}" class="btn btn-success"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>    
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataSiswa").addClass("active");
    </script>
@endsection

@extends('template_backend.home')
@section('heading', 'Details Orang Tua')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('orang_tua.index') }}">Orang Tua</a></li>
  <li class="breadcrumb-item active">Details Orang Tua</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-4">
                    <img src="{{ asset($orang_tua->foto) }}" class="card-img img-details" alt="...">
                </div>
                <div class="col-md-1 mb-4"></div>
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">Nama : {{ $orang_tua->nama }}</h5>
                    <h5 class="card-title card-text mb-2">NIK : {{ $orang_tua->nik }}</h5>
                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $orang_tua->tmp_lahir }}</h5>
                    <h5 class="card-title card-text mb-2">Tanggal Lahir : {{ date('l, d F Y', strtotime($orang_tua->tgl_lahir)) }}</h5>
                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $orang_tua->telp }}</h5>
                    @if ($orang_tua->jk == 'L')
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Laki-laki</h5>
                    @else
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Perempuan</h5>
                    @endif
                    <h5 class="card-title card-text mb-2">Agama : {{ $orang_tua->agama }}</h5>
                    <h5 class="card-title card-text mb-2">Pendidikan : {{ strtoupper($orang_tua->pendidikan) }}</h5>
                    <h5 class="card-title card-text mb-2">Golongan Darah : {{ $orang_tua->goldar }}</h5>
                    <h5 class="card-title card-text mb-2">Pekerjaan : {{ $orang_tua->pekerjaan }}</h5>
                    <h5 class="card-title card-text mb-2">Alamat : {{ $orang_tua->alamat }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataOrangTua").addClass("active");
    </script>
@endsection
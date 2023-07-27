@extends('template.home')
@section('heading', 'Details Guru')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('orang_tua.index') }}">Guru</a></li>
  <li class="breadcrumb-item active">Details Guru</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-4">
                    @if ($orang_tua->foto)
                        <img src="{{ asset('uploads/orang_tua/'.$orang_tua->foto) }}" class="card-img img-details" alt="{{ $orang_tua->nama }}">
                    @else
                        <h3>Tidak ada foto</h3>
                    @endif
                </div>
                <div class="col-md-1 mb-4"></div>
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">NIK : {{ $orang_tua->nik }}</h5>
                    <h5 class="card-title card-text mb-2">Nama : {{ $orang_tua->nama }}</h5>
                    <h5 class="card-title card-text mb-2">Jenis Kelamin : {{ $orang_tua->jk === "L" ? "Laki-laki" : "Perempuan" }}</h5>
                    <h5 class="card-title card-text mb-2">Agama : {{ $orang_tua->agama() }}</h5>
                    <h5 class="card-title card-text mb-2">Goldar : {{ $orang_tua->goldar() }}</h5>
                    <h5 class="card-title card-text mb-2">Pekerjaan : {{ $orang_tua->pekerjaan() }}</h5>
                    <h5 class="card-title card-text mb-2">Pendidikan : {{ $orang_tua->pendidikan() }}</h5>
                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $orang_tua->telp }}</h5>
                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $orang_tua->tmp_lahir }}</h5>
                    <h5 class="card-title card-text mb-2">Tanggal Lahir : {{ date('l, d F Y', strtotime($orang_tua->tgl_lahir)) }}</h5>
                    <h5 class="card-title card-text mb-2">Alamat : {{ $orang_tua->alamat }}</h5> 
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('orang_tua.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <?php $enc_id = Crypt::encrypt($orang_tua->id); ?>
            <a href="{{ route('orang_tua.edit', $enc_id) }}" class="btn btn-success"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>    
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataGuru").addClass("active");
    </script>
@endsection
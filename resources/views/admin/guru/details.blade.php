@extends('template_backend.home')
@section('heading', 'Details Guru')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('guru.index') }}">Guru</a></li>
  <li class="breadcrumb-item active">Details Guru</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-4">
                    <img src="{{ asset($guru->foto) }}" class="card-img img-details" alt="...">
                </div>
                <div class="col-md-1 mb-4"></div>
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">Nama : {{ $guru->nama }}</h5>
                    <h5 class="card-title card-text mb-2">NIK : {{ $guru->nik }}</h5>
                    <h5 class="card-title card-text mb-2">NIP : {{ $guru->nip }}</h5>
                    @if ($guru->jk == 'L')
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Laki-laki</h5>
                    @else
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Perempuan</h5>
                    @endif
                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $guru->tmp_lahir }}</h5>
                    <h5 class="card-title card-text mb-2">Tanggal Lahir : {{ date('l, d F Y', strtotime($guru->tgl_lahir)) }}</h5>
                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $guru->telp }}</h5>
                </div>
            </div>
        </div>
        <div class="card-footer">
          <a href="{{ route('guru.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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
@extends('template.home')
@section('heading', 'Detail Keluarga')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('kk.index') }}">Keluarga</a></li>
  <li class="breadcrumb-item active">Detail Keluarga</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">Nama Ayah : {{ $ayah->nama ?? "" }}</h5>
                    @foreach ($ibu as $v)
                        <h5 class="card-title card-text mb-2">Nama Ibu {{ $loop->iteration }}: {{ $v->nama ?? "" }}</h5>
                    @endforeach
                    @foreach ($anak as $v)
                        <h5 class="card-title card-text mb-2">Nama Anak {{ $loop->iteration }} : {{ $v->nama ?? "" }}</h5>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('kk.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;    
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataKartuKeluarga").addClass("active");
    </script>
@endsection

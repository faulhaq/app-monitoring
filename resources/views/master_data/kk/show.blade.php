@extends('template.home')
@section('heading', 'Detail KK')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('kk.index') }}">KK</a></li>
  <li class="breadcrumb-item active">Detail KK</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h1>{{ $kk->no_kk }}</h1>
        </div>
        <div class="card-footer">
            <a href="{{ route('kk.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <?php $enc_id = Crypt::encrypt($kk->id); ?>   
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

@extends('template.home')
@section('heading', 'Details User')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">Guru</a></li>
  <li class="breadcrumb-item active">Details Guru</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">Role : {{ $user->role }}</h5>
                    <h5 class="card-title card-text mb-2">Nama : {{ $user->nama() }}</h5>
                    <h5 class="card-title card-text mb-2">Email : {{ $user->email }}</h5>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('user.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <?php $enc_id = Crypt::encrypt($user->id); ?>
            <a href="{{ route('user.edit', $enc_id) }}" class="btn btn-success"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>    
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataUser").addClass("active");
    </script>
@endsection

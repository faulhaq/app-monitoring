@extends('template.home')
@section('heading', 'Profile')
@section('page')
  <li class="breadcrumb-item active">User Profile</li>
@endsection
@section('content')
<?php
$user = Auth::user();
if ($user->role === "guru") {
    $guru = $user->guru();
    $foto = (!empty($guru->foto)) ? "uploads/guru/".$guru->foto : NULL;
} else {
    $orang_tua = $user->orang_tua();
}

if ($foto) {
    $data_footer = '<a href="'.route('pengaturan.edit-foto').'" id="linkFotoGuru" class="btn btn-link btn-block btn-light"><i class="nav-icon fas fa-file-upload"></i> &nbsp; Ubah Foto</a>';
}

$name = $user->name();
?>
<div class="col-12">
    <div class="row">
        <div class="col-5">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    @if ($foto)
                        <a href="{{ $foto }}" data-toggle="lightbox" data-title="Foto {{ $name }}" data-gallery="gallery" data-footer="{{ $data_footer }}">
                            <img src="{{ $foto }}" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        </a>
                    @else
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/male.jpg') }}" alt="User profile picture">
                    @endif
                    </div>
                    <h3 class="profile-username text-center">{{ $name }}</h3>
                    <p class="text-muted text-center"> Role : {{ $user->role() }}</p>
                    @if ($user->role !== 'admin')
                    <a href="{{ route('pengaturan.profile') }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Akun</h3>
                </div>
                <div class="card-body">
                    <table class="table" style="margin-top: -21px;">
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-key"></i></td>
                        <td>Ubah Password</td>
                        <td width="50"><a href="{{ route('pengaturan.password') }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col -->
        
        <div class="col-7">
            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($user->role == 'guru')
                        <strong><i class="far fa-envelope mr-1"></i> NIP</strong>
                        <p class="text-muted">{{ $guru->nip }}</p>
                        <hr>
                    @endif

                    <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                    <p class="text-muted">{{ $user->email }}</p>
                    <hr>

                    <strong><i class="far fa-calendar mr-1"></i> Tanggal Lahir</strong>
                    <p class="text-muted">{{ date('l, d F Y', strtotime($guru->tgl_lahir)) }}</p>
                    <hr>

                    <strong><i class="fas fa-phone mr-1"></i> No Telepon</strong>
                    <p class="text-muted">{{ $guru->telp }}</p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection
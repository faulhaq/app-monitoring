@extends('template.home')
@section('heading', 'Edit User')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">User</a></li>
  <li class="breadcrumb-item active">Edit User</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('user.update', Crypt::encrypt($user->id)) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <?php
            $role = $user->role;
            if ($role === "orang_tua")
                $role = "Orang Tua";
            else if ($role === "admin")
                $role = "Admin";
            else if ($role === "guru")
                $role = "Guru";
        ?>
        <div class="card-body">
            <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input autocomplete="off" type="text" value="{{ $role }}" id="role" name="role" class="form-control @error('role') is-invalid @enderror" disabled>
                        </div>
                        <div class="form-group" id="email_fg">
                            <label for="email">Email</label>
                            <input autocomplete="off" type="email" value="{{ $user->email }}" id="email" name="email" class="form-control @error('email') is-invalid @enderror" disabled>
                        </div>
                        <div class="form-group" id="password_fg">
                            <label for="password">Password</label>
                            <input autocomplete="off" type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ URL::previous() }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataUser").addClass("active");
</script>
@endsection

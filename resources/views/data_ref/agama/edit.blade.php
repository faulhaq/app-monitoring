@extends('template.home')
@section('heading', 'Edit Agama')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('guru.index') }}">Agama</a></li>
  <li class="breadcrumb-item active">Edit Agama</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Agama</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('data_ref.agama.update', Crypt::encrypt($agama->id)) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_induk">ID</label>
                    <input type="text" id="id" name="id" value="{{ $agama->id }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Agama</label>
                    <input type="text" id="nama" name="nama" value="{{ $agama->nama }}" class="form-control">
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
    $("#DataRef").addClass("active");
    $("#liDataRef").addClass("menu-open");
    $("#DataRefAgama").addClass("active");
</script>
@endsection
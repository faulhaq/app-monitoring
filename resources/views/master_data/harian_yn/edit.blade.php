@extends('template.home')
@section('heading', 'Edit Data Harian Yn')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('harian_yn.index') }}">Data Harian Yn</a></li>
  <li class="breadcrumb-item active">Edit Data Harian Yn</li>
@endsection
@section('content')
<?php
$checked = $harian->status === "aktif" ? " checked" : "";
?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Harian Yn</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('harian_yn.update', Crypt::encrypt($harian->id)) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
              <div class="col-md">
                  <div class="form-group">
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="status" value="aktif" id="flexCheckDefault" {!! $checked !!}/>
                          <label class="form-check-label" for="flexCheckDefault">
                              Aktif
                          </label>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="pertanyaan">Pertanyaan</label>
                        <textarea id="pertanyaan" name="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror" required>{{ $harian->pertanyaan }}</textarea>
                    </div>
                </div>
            </div>
            @include('master_data.harian_tujuan')
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ route('harian_yn.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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
    $("#DataHarianYn").addClass("active");
</script>
@endsection

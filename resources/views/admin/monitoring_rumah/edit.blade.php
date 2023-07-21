@extends('template_backend.home')
@section('heading', 'Edit Monitoring Rumah')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('monitoring_rumah.index') }}">Monitoring Rumah</a></li>
  <li class="breadcrumb-item active">Edit Monitoring Rumah</li>
@endsection
@section('content')
<?php
$data = json_decode($monitoring->data, true);
$data = $data["q"] ?? "";
$data_pertanyaan = $data;
?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Monitoring Rumah</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('monitoring_rumah.update', Crypt::encrypt($monitoring->id)) }}" method="post">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="id">ID</label>
                  <input id="id" type="text" value="{{ $monitoring->id }}" class="form-control" disabled="1">
                </div>
                <div class="form-group">
                  <label for="tipe">Tipe</label>
                  <select id="tipe" class="form-control @error('tipe') is-invalid @enderror select2bs4" name="tipe" value="{{ old('tipe') }}" autocomplete="tipe">
                    <option value="yes_no"<?= $monitoring->tipe === "yes_no" ? "selected" : ""; ?>>Yes/No</option>
                    <option value="isian"<?= $monitoring->tipe === "isian" ? "selected" : ""; ?>>Isian</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pertanyaan">Pertanyaan</label>
                  <input id="pertanyaan" type="text" value="{{ $data_pertanyaan }}" class="form-control @error('pertanyaan') is-invalid @enderror" name="data" autocomplete="pertanyaan">
                  @error('pertanyaan')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="pertanyaan">Tujuan Kelas</label>

                  @foreach ($kelas as $v)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tujuan_kelas[]" value="{{ $v->id }}"<?= isset($checked_kelas[$v->id]) ? " checked" : "" ?>/>
                    <label class="form-check-label" for="flexCheckDefault">{{ $v->nama_kelas }}</label>
                  </div>
                  @endforeach
                  
                  @error('pertanyaan')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <a href="{{ route('monitoring_rumah.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
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
    $("#DataOrangTua").addClass("active");
</script>
@endsection
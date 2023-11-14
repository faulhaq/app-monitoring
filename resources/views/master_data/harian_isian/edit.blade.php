@extends('template.home')
@section('heading', 'Edit Data Harian Isian')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('harian_isian.index') }}">Data Harian Isian</a></li>
  <li class="breadcrumb-item active">Edit Data Harian Isian</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Harian Isian</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('harian_isian.update', Crypt::encrypt($harian->id)) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
            <div class="col-md">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="tgl_mulai">Tanggal Mulai</label>
                        <input type="date" id="tgl_mulai" value="{{ $harian->tgl_mulai }}" name="tgl_mulai" class="form-control @error('tgl_mulai') is-invalid @enderror" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="tgl_selesai">Tanggal Selesai</label>
                        <input type="date" id="tgl_selesai" value="{{ $harian->tgl_selesai }}" name="tgl_selesai" class="form-control @error('tgl_selesai') is-invalid @enderror" required>
                    </div>
                </div>
            </div>
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
          <a href="{{ route('harian_isian.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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
    $("#DataHarianIsian").addClass("active");
</script>
@endsection

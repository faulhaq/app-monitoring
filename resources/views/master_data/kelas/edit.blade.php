@extends('template.home')
@section('heading', 'Edit Kelas')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">Kelas</a></li>
  <li class="breadcrumb-item active">Edit Kelas</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Kelas</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('kelas.update', Crypt::encrypt($kelas->id)) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="row" style="padding: 30px">
            <div class="col-md">
                <div class="form-group">
                    <label for="tingkatan">Kelas</label>
                    <select id="tingkatan" name="tingkatan" class="select2bs4 form-control @error('tingkatan') is-invalid @enderror">
                        <option value="">-- Pilih Kelas --</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <?php $sel = $kelas->tingkatan == $i ? " selected" : "" ?>
                            <option value="{{ $i }}"<?= $sel ?>>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Kelas (Misal: A, B, C, D, E)</label>
                    <input type="text" id="nama" name="nama" value="{{ $kelas->nama }}" class="form-control @error('nama') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    <select id="tahun_ajaran" name="tahun_ajaran" class="select2bs4 form-control @error('tahun_ajaran') is-invalid @enderror">
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        @foreach ($tahun_ajaran as $v)
                            <?php $sel = $kelas->tahun_ajaran()->id == $v->id ? " selected" : "" ?>
                            <option value="{{ $v->id }}"<?= $sel ?>>{{ $v->tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="wali_kelas">Wali Kelas</label>
                    <select id="wali_kelas" name="wali_kelas" class="select2bs4 form-control @error('wali_kelas') is-invalid @enderror">
                        <option value="">-- Pilih Wali Kelas --</option>
                        @foreach ($guru as $v)
                            <?php $sel = $kelas->wali_kelas()->id == $v->id ? " selected" : "" ?>
                            <option value="{{ $v->id }}"<?= $sel ?>>({{ $v->nik }}) {{ $v->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

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
    $("#DataKelas").addClass("active");
</script>
@endsection

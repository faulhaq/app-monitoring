@extends('template.home')
@section('heading', 'Edit Siswa')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></li>
  <li class="breadcrumb-item active">Edit Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Siswa</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('siswa.update', Crypt::encrypt($siswa->id)) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_induk">NIK</label>
                    <input type="text" id="nik" name="nik" value="{{ $siswa->nik }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="no_induk">NIS</label>
                    <input type="text" id="nis" name="nis" value="{{ $siswa->nis }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Siswa</label>
                    <input type="text" id="nama" name="nama" value="{{ $siswa->nama }}" class="form-control @error('nama') is-invalid @enderror" required>
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L"
                            @if ($siswa->jk == 'L')
                                selected
                            @endif
                        >Laki-Laki</option>
                        <option value="P"
                            @if ($siswa->jk == 'P')
                                selected
                            @endif
                        >Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tmp_lahir">Tempat Lahir</label>
                    <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ $siswa->tmp_lahir }}" class="form-control @error('tmp_lahir') is-invalid @enderror" required>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $siswa->tgl_lahir }}" class="form-control @error('tgl_lahir') is-invalid @enderror" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <select id="agama" name="agama" class="select2bs4 form-control @error('agama') is-invalid @enderror" required>
                    <option value="">-- Pilih Agama --</option>
                        <?= FormWithRef::get_agama($siswa->agama); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select id="kelas" name="kelas" class="select2bs4 form-control @error('kelas') is-invalid @enderror">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $v)
                            <?php $sel = ($siswa->kelas()->id === $v->id) ? " selected" : ""; ?>
                            <option value="{{ $v->id }}"<?= $sel ?>>{{ $v->tingkatan.$v->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="goldar">Golongan Darah</label>
                    <select id="goldar" name="goldar" class="select2bs4 form-control @error('goldar') is-invalid @enderror">
                        <option value="">-- Pilih Golongan Darah --</option>
                        <?= FormWithRef::get_goldar($siswa->goldar); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telp">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ $siswa->alamat }}"  class="form-control @error('alamat') is-invalid @enderror" required>
                </div>
                <div class="form-group">
                    <label for="telp">Nomor Telpon/HP</label>
                    <input type="text" id="telp" name="telp" value="{{ $siswa->telp }}" class="form-control @error('telp') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="foto">File Foto</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
                            <label class="custom-file-label" for="foto">Choose file</label>
                        </div>
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
    $("#DataSiswa").addClass("active");
</script>
@endsection

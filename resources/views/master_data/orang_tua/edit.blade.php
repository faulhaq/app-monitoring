@extends('template.home')
@section('heading', 'Edit Orang Tua')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('orang_tua.index') }}">Orang Tua</a></li>
  <li class="breadcrumb-item active">Edit Orang Tua</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Orang Tua</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <?php $enc_id = Crypt::encrypt(json_encode([
            "id_orang_tua" => $orang_tua->id,
            "id_siswa"     => $siswa->id
      ])); ?>
      <form action="{{ route('orang_tua.update', $enc_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_kk">No. KK</label>
                    <input type="text" id="no_kk" name="no_kk" value="{{ $orang_tua->kk()->no_kk }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="no_induk">NIK</label>
                    <input type="text" id="nik" name="nik" value="{{ $orang_tua->nik }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ $orang_tua->nama }}" class="form-control @error('nama') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $orang_tua->email }}" class="form-control @error('email') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L"
                            @if ($orang_tua->jk == 'L')
                                selected
                            @endif
                        >Laki-Laki</option>
                        <option value="P"
                            @if ($orang_tua->jk == 'P')
                                selected
                            @endif
                        >Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tmp_lahir">Tempat Lahir</label>
                    <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ $orang_tua->tmp_lahir }}" class="form-control @error('tmp_lahir') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $orang_tua->tgl_lahir }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <select id="agama" name="agama" class="select2bs4 form-control @error('agama') is-invalid @enderror">
                    <option value="">-- Pilih Agama --</option>
                        <?= FormWithRef::get_agama($orang_tua->agama); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <select id="pendidikan" name="pendidikan" class="select2bs4 form-control @error('pendidikan') is-invalid @enderror">
                        <option value="">-- Pilih Pendidikan Terakhir --</option>
                        <?= FormWithRef::get_pendidikan($orang_tua->pendidikan); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="goldar">Golongan Darah</label>
                    <select id="goldar" name="goldar" class="select2bs4 form-control @error('goldar') is-invalid @enderror">
                        <option value="">-- Pilih Golongan Darah --</option>
                        <?= FormWithRef::get_goldar($orang_tua->goldar); ?>
                    </select>
                    </div>
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <select id="pekerjaan" name="pekerjaan" class="select2bs4 form-control @error('pekerjaan') is-invalid @enderror">
                        <option value="">-- Pilih Pekerjaan --</option>
                        <?= FormWithRef::get_pekerjaan($orang_tua->pekerjaan); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ $orang_tua->alamat }}"  class="form-control @error('alamat') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="telp">Nomor Telpon/HP</label>
                    <input type="text" id="telp" name="telp" value="{{ $orang_tua->telp }}" class="form-control @error('telp') is-invalid @enderror">
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
        <?php $enc_id_siswa = Crypt::encrypt($id["id_siswa"]); ?>
            <a href="{{ route('orang_tua.list_orang_tua', $enc_id_siswa) }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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
    $("#DataOrangTua").addClass("active");
</script>
@endsection

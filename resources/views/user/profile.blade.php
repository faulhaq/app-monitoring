@extends('template.home')
@section('heading', 'Edit Profile')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('profile') }}">Pengaturan</a></li>
  <li class="breadcrumb-item active">Edit Profile</li>
@endsection
@section('content')
<?php
$user = Auth::user();
?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title text-capitalize">Edit Profile {{ $user->name() }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('pengaturan.ubah-profile') }}" method="post" enctype="multipart/form-data"> @csrf 
        <div class="card-body"> 
            @if ($user->role == "guru")
            @php $guru = $user->guru(); @endphp
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" id="nik" name="nik" value="{{ $guru->nik }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" id="nip" name="nip" value="{{ $guru->nip }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Guru</label>
                            <input type="text" id="nama" name="nama" value="{{ $guru->nama }}" class="form-control @error('nama') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="{{ $guru->email }}" class="form-control @error('email') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" @if ($guru->jk == 'L') selected @endif >Laki-Laki</option>
                                <option value="P" @if ($guru->jk == 'P') selected @endif >Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tmp_lahir">Tempat Lahir</label>
                            <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ $guru->tmp_lahir }}" class="form-control @error('tmp_lahir') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $guru->tgl_lahir }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select id="agama" name="agama" class="select2bs4 form-control @error('agama') is-invalid @enderror">
                                <option value="">-- Pilih Agama --</option> <?= FormWithRef::get_agama($guru->agama); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pendidikan">Pendidikan</label>
                            <select id="pendidikan" name="pendidikan" class="select2bs4 form-control @error('pendidikan') is-invalid @enderror">
                                <option value="">-- Pilih Pendidikan Terakhir --</option> <?= FormWithRef::get_pendidikan($guru->pendidikan); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="goldar">Golongan Darah</label>
                            <select id="goldar" name="goldar" class="select2bs4 form-control @error('goldar') is-invalid @enderror">
                                <option value="">-- Pilih Golongan Darah --</option> <?= FormWithRef::get_goldar($guru->goldar); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <select id="pekerjaan" name="pekerjaan" class="select2bs4 form-control @error('pekerjaan') is-invalid @enderror">
                                <option value="">-- Pilih Pekerjaan --</option> <?= FormWithRef::get_pekerjaan($guru->pekerjaan); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" value="{{ $guru->alamat }}" class="form-control @error('alamat') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="telp">Nomor Telpon/HP</label>
                            <input type="text" id="telp" name="telp" value="{{ $guru->telp }}" class="form-control @error('telp') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="select2bs4 form-control @error('status') is-invalid @enderror">
                                <option value="aktif" <?= $guru->status === "aktif" ? " selected" : ""?>>Aktif </option>
                                <option value="non-aktif" <?= $guru->status === "non-aktif" ? " selected" : ""?>>Non-aktif </option>
                            </select>
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
            @elseif ($user->role === 'orang_tua')
            @php $orang_tua = $user->orang_tua(); @endphp
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
            @endif
        
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="#" name="kembali" class="btn btn-default" id="back">
                    <i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali </a> &nbsp; <button name="submit" class="btn btn-primary">
                    <i class="nav-icon fas fa-save"></i> &nbsp; Simpan </button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#back').click(function() {
            window.location="{{ route('profile') }}";
        });
    });
</script>
@endsection
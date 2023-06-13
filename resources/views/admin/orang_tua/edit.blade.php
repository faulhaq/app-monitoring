@extends('template_backend.home')
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
      <form action="{{ route('orang_tua.update', $orang_tua->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_induk">NIK</label>
                    <input type="text" id="nik" name="nik" value="{{ $orang_tua->nik }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Orang Tua</label>
                    <input type="text" id="nama" name="nama" value="{{ $orang_tua->nama }}" class="form-control @error('nama') is-invalid @enderror">
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
                <div class="form-group">
                    <label for="telp">Nomor Telpon/HP</label>
                    <input type="text" id="telp" name="telp" value="{{ $orang_tua->telp }}" class="form-control @error('telp') is-invalid @enderror">
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="agama">Agama</label>
                        <select id="agama" name="agama" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                            <option value="islam" <?= $orang_tua->agama === "islam" ? "selected" : "" ?>>Islam</option>
                            <option value="kristen" <?= $orang_tua->agama === "kristen" ? "selected" : "" ?>>Kristen</option>
                            <option value="katholik" <?= $orang_tua->agama === "katholik" ? "selected" : "" ?>>Katholik</option>
                            <option value="budha" <?= $orang_tua->agama === "budha" ? "selected" : "" ?>>Budha</option>
                            <option value="kong hu cu" <?= $orang_tua->agama === "kong hu cu" ? "selected" : "" ?>>Kong Hu Cu</option>
                            <option value="hindu" <?= $orang_tua->agama === "hindu" ? "selected" : "" ?>>Hindu</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                        <select id="pendidikan" name="pendidikan" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                            <option value="sd" <?= $orang_tua->pendidikan === "sd" ? "selected" : "" ?>>SD</option>
                            <option value="smp/sltp" <?= $orang_tua->pendidikan === "smp/sltp" ? "selected" : "" ?>>SMP/SLTP</option>
                            <option value="sma/smk" <?= $orang_tua->pendidikan === "sma/smk" ? "selected" : "" ?>>SMA/SMK</option>
                            <option value="d1/d2/d3" <?= $orang_tua->pendidikan === "d1/d2/d3" ? "selected" : "" ?>>D1/D2/D3</option>
                            <option value="s1" <?= $orang_tua->pendidikan === "s1" ? "selected" : "" ?>>S1</option>
                            <option value="s2" <?= $orang_tua->pendidikan === "s2" ? "selected" : "" ?>>S2</option>
                            <option value="s3" <?= $orang_tua->pendidikan === "s3" ? "selected" : "" ?>>S3</option>
                        </select>
                </div>
                <div class="form-group">
                <label for="goldar">Golongan Darah</label>
                        <select id="goldar" name="goldar" class="select2bs4 form-control @error('goldar') is-invalid @enderror">
                            <option value="A" <?= $orang_tua->goldar === "A" ? "selected" : "" ?>>A</option>
                            <option value="B" <?= $orang_tua->goldar === "B" ? "selected" : "" ?>>B</option>
                            <option value="AB" <?= $orang_tua->goldar === "AB" ? "selected" : "" ?>>AB</option>
                            <option value="O" <?= $orang_tua->goldar === "O" ? "selected" : "" ?>>O</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="telp">Pekerjaan</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" value="{{ $orang_tua->pekerjaan }}" class="form-control @error('pekerjaan') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="telp">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ $orang_tua->alamat }}"  class="form-control @error('alamat') is-invalid @enderror">
                </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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
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
                    <label for="no_induk">Nomor Induk</label>
                    <input type="text" id="no_induk" name="no_induk" value="{{ $orang_tua->no_induk }}" class="form-control" readonly>
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
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_kelas">Kelas</label>
                    <select id="id_kelas" name="id_kelas" class="select2bs4 form-control @error('id_kelas') is-invalid @enderror">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $data)
                            <option value="{{ $data->id }}"
                                @if ($orang_tua->id_kelas == $data->id)
                                    selected
                                @endif
                            >{{ $data->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="telp">Nomor Telpon/HP</label>
                    <input type="text" id="telp" name="telp" value="{{ $orang_tua->telp }}" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $orang_tua->tgl_lahir }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
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
    $(document).ready(function() {
        $('#back').click(function() {
        window.location="{{ route('orang_tua.kelas', Crypt::encrypt($orang_tua->id_kelas)) }}";
        });
    });
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataOrangTua").addClass("active");
</script>
@endsection
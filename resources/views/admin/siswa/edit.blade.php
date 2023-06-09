@extends('template_backend.home')
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
      <form action="{{ route('siswa.update', $siswa->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" id="nik" name="nik" value="{{ $siswa->nik }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" id="nis" name="nis" onkeypress="return inputAngka(event)" value="{{ $siswa->nis }}" class="form-control @error('nis') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Siswa</label>
                    <input type="text" id="nama" name="nama" value="{{ $siswa->nama }}" class="form-control @error('nama') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
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
                    <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ $siswa->tmp_lahir }}" class="form-control @error('tmp_lahir') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $siswa->tgl_lahir }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
                </div>
                
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label for="agama">Agama</label>
                        <select id="agama" name="agama" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                            <option value="islam" <?= $siswa->agama === "islam" ? "selected" : "" ?>>Islam</option>
                            <option value="kristen" <?= $siswa->agama === "kristen" ? "selected" : "" ?>>Kristen</option>
                            <option value="katholik" <?= $siswa->agama === "katholik" ? "selected" : "" ?>>Katholik</option>
                            <option value="budha" <?= $siswa->agama === "budha" ? "selected" : "" ?>>Budha</option>
                            <option value="kong hu cu" <?= $siswa->agama === "kong hu cu" ? "selected" : "" ?>>Kong Hu Cu</option>
                            <option value="hindu" <?= $siswa->agama === "hindu" ? "selected" : "" ?>>Hindu</option>
                        </select>
                </div>
                <div class="form-group">
                <label for="goldar">Golongan Darah</label>
                        <select id="goldar" name="goldar" class="select2bs4 form-control @error('goldar') is-invalid @enderror">
                            <option value="A" <?= $siswa->goldar === "A" ? "selected" : "" ?>>A</option>
                            <option value="B" <?= $siswa->goldar === "B" ? "selected" : "" ?>>B</option>
                            <option value="AB" <?= $siswa->goldar === "AB" ? "selected" : "" ?>>AB</option>
                            <option value="O" <?= $siswa->goldar === "O" ? "selected" : "" ?>>O</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="id_kelas">Kelas</label>
                    <select id="id_kelas" name="id_kelas" class="select2bs4 form-control @error('id_kelas') is-invalid @enderror">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $data)
                            <option value="{{ $data->id }}"
                                @if ($siswa->id_kelas == $data->id)
                                    selected
                                @endif
                            >{{ $data->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="telp">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ $siswa->alamat }}"  class="form-control @error('alamat') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="telp">Nomor Telpon/HP</label>
                    <input type="text" id="telp" name="telp" value="{{ $siswa->telp }}" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror">
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
        window.location="{{ route('siswa.kelas', Crypt::encrypt($siswa->id_kelas)) }}";
        });
    });
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataSiswa").addClass("active");
</script>
@endsection
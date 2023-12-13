@extends('template.home')
@section('heading', 'Data Siswa')
@section('page')
  <li class="breadcrumb-item active">Data Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Siswa
                </button>
            </h3>  
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="filter_kelas">Filter Kelas</label>
                        <select id="filter_kelas" name="filter_kelas" class="select2bs4 form-control">
                            <option value="all">Semua Kelas</option>
                            @foreach ($kelas as $v)
                                <?php $ta = $v->tahun_ajaran(); ?>
                                @if ($ta->id == $id_tahun_ajaran_aktif)
                                <?php $sel = $v->id == $fkelas ? " selected" : ""; ?>
                                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->tingkatan.$v->nama." (TA: {$ta->tahun})" }} (aktif)</option>
                                @endif
                            @endforeach
                            @foreach ($kelas as $v)
                                <?php $ta = $v->tahun_ajaran(); ?>
                                @if ($ta->id != $id_tahun_ajaran_aktif)
                                <?php $sel = $v->id == $fkelas ? " selected" : ""; ?>
                                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->tingkatan.$v->nama." (TA: {$ta->tahun})" }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="filter_status">Filter Status</label>
                        <select id="filter_status" name="filter_status" class="select2bs4 form-control">
                            <option value="all">Semua Status</option>
                            <?= \App\Http\Controllers\SiswaController::status_drop_down($fstatus); ?>
                        </select>
                    </div>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $data)
                <?php $kelas = $data->kelas(); ?>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $kelas ? $kelas->tingkatan.$kelas->nama : "" }}</td>
                    <td>{{ $data->jk === "L" ? "Laki-laki" : "Perempuan" }}</td>
                    <td>{{ $data->status() }}</td>
                    <td>
                        <?php $enc_id = Crypt::encrypt($data->id); ?>
                        <form action="{{ route('siswa.destroy', $enc_id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('siswa.show', $enc_id) }}" class="btn btn-info btn-sm mt-2"><i class="nav-icon fas fa-id-card"></i> &nbsp; Detail</a>
                            <a href="{{ route('siswa.edit', $enc_id) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                            <button class="btn btn-danger btn-sm mt-2"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('siswa.store') }}" method="post" enctype="multipart/form-data"> @csrf <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_kk">No. KK</label>
                                <input type="text" id="no_kk" name="no_kk" onkeypress="return inputAngka(event)" class="form-control @error('no_kk') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" id="nik" name="nik" onkeypress="return inputAngka(event)" class="form-control @error('nik') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" id="nis" name="nis" onkeypress="return inputAngka(event)" class="form-control @error('nis') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Siswa</label>
                                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select id="agama" name="agama" class="select2bs4 form-control @error('agama') is-invalid @enderror" required>
                                    <option value="">-- Pilih Agama --</option> <?= FormWithRef::get_agama(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tmp_lahir">Tempat Lahir</label>
                                <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nis">Alamat</label>
                                <input type="text" id="alamt" name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label for="telp">Nomor Telpon/HP</label>
                                <input type="text" id="telp" name="telp" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror">
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label for="goldar">Golongan Darah</label>
                                <select id="goldar" name="goldar" class="select2bs4 form-control @error('goldar') is-invalid @enderror">
                                    <option value="">-- Pilih Golongan Darah --</option> <?= FormWithRef::get_goldar(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="select2bs4 form-control @error('status') is-invalid @enderror" required>
                                    <option value="">-- Pilih Status --</option> <?= \App\Http\Controllers\SiswaController::status_drop_down(); ?>
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
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali </button>
                <button type="submit" class="btn btn-primary">
                    <i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataSiswa").addClass("active");

    let fkelas = $("#filter_kelas");
    let fstatus = $("#filter_status");

    function construct_query_string()
    {
        return "?fkelas=" + encodeURIComponent(fkelas.val()) +
               "&fstatus=" + encodeURIComponent(fstatus.val());
    }

    function handle_filter_change()
    {
        window.location = construct_query_string();
    }

    fkelas.change(handle_filter_change);
    fstatus.change(handle_filter_change);
</script>
@endsection

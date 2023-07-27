@extends('template.home')
@section('heading', 'Data Tahun Ajaran')
@section('page')
  <li class="breadcrumb-item active">Data Tahun Ajaran</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Tahun Ajaran
                </button>
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".modal-set-aktif">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Ubah Tahun Aktif
                </button>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tahun_ajaran as $v)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $v->tahun }}</td>
                    <td>{{ $v->status() }}</td>
                    <td>{{ date("d F Y H:i:s", strtotime($v->created_at)) }}</td>
                    <td>
                        <?php $enc_id = Crypt::encrypt($v->id); ?>
                        <form action="{{ route('orang_tua.destroy', $enc_id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('orang_tua.show', $enc_id) }}" class="btn btn-info btn-sm mt-2"><i class="nav-icon fas fa-id-card"></i> &nbsp; Detail</a>
                            <a href="{{ route('orang_tua.edit', $enc_id) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
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
<div class="modal fade modal-set-aktif" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Ubah Tahun Aktif</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('tahun_ajaran.aktifkan_tahun') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="tahun">Tahun Ajaran</label>
                        <select id="tahun" name="tahun" class="select2bs4 form-control @error('tahun') is-invalid @enderror">
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @foreach ($tahun_ajaran as $v)
                                <option value="{{ $v->id }}">{{ $v->tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Aktifkan</button>
          </form>
      </div>
      </div>
    </div>
</div>

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Tahun Ajaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('tahun_ajaran.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahun">Tahun Ajaran</label>
                        <select id="tahun" name="tahun" class="select2bs4 form-control @error('tahun') is-invalid @enderror">
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @for ($i = 2022; $i <= 2100; $i++)
                                <?= $j = $i."/".($i+1); ?>
                                <option value="{{ $j }}">{{ $j }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="select2bs4 form-control @error('status') is-invalid @enderror">
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif">Aktif</option>
                            <option value="non-aktif">Non Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
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
        $("#DataTahunAjaran").addClass("active");
    </script>
@endsection

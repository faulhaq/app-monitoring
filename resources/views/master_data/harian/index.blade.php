@extends('template.home')
@section('heading', 'Data Monitoring Harian')
@section('page')
  <li class="breadcrumb-item active">Data Monitoring Harian</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('harian.create') }}">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Monitoring Harian
                    </button>
                </a>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow-x: scroll">
            <div class="row">
                <div class="col-md">
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kelas</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Dibuat Pada</th>
                    <th>Diubah Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($harian as $v)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $v->kelas->nama_kelas() }}</td>
                    <td>{{ $v->bulan() }}</td>
                    <td>{{ $v->tahun }}</td>
                    <td>{{ fix_id_d($v->created_at) }}</td>
                    <td>{{ fix_id_d($v->updated_at) }}</td>
                    <td>
                        <?php $enc_id = Crypt::encrypt($v->id); ?>
                        <form action="{{ route('harian.destroy', $enc_id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('harian.edit', $enc_id) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
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
                <h4 class="modal-title">Tambah Data Monitoring Harian Isian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('harian.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('master_data.harian_tujuan')
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="tgl_mulai">Bulan</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="tgl_mulai">Tahun</label>
                                <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control @error('tgl_mulai') is-invalid @enderror" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
                    </div>
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
    $("#DataHarian").addClass("active");
</script>
@endsection

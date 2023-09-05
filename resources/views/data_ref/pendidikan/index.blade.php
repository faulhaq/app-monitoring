@extends('template.home')
@section('heading', 'Data Ref Pendidikan')
@section('page')
  <li class="breadcrumb-item active">Data Ref Pendidikan</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Ref Pendidikan
                </button>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body" style="overflow-x: scroll">
          <table class="table table-bordered table-striped table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Nama Pendidikan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendidikan as $v)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->nama }}</td>
                    <td>
                        <?php $enc_id = Crypt::encrypt($v->id); ?>
                        <form action="{{ route('data_ref.pendidikan.destroy', $enc_id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('data_ref.pendidikan.edit', $enc_id) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
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
          <h4 class="modal-title">Tambah Data Pendidikan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('data_ref.pendidikan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama">Nama Pendidikan</label>
                        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
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
        $("#DataRef").addClass("active");
        $("#liDataRef").addClass("menu-open");
        $("#DataRefPendidikan").addClass("active");
    </script>
@endsection

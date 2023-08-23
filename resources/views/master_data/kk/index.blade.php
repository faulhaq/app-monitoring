@extends('template.home')
@section('heading', 'Data KK')
@section('page')
  <li class="breadcrumb-item active">Data KK</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data KK
                </button>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow-x: scroll">
            <table id="example1" class="table table-bordered table-striped table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No KK</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kk as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->no_kk }}</td>
                    <td>
                        <?php $enc_id = Crypt::encrypt($data->id); ?>
                        <form action="{{ route('kk.destroy', $enc_id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('kk.show', $enc_id) }}" class="btn btn-info btn-sm mt-2"><i class="nav-icon fas fa-id-card"></i> &nbsp; Detail</a>
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
          <h4 class="modal-title">Tambah Data KK</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('kk.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="no_kk">No KK</label>
                        <input type="text" id="no_kk" name="no_kk" onkeypress="return inputAngkaMax(event, 16)" class="form-control @error('no_kk') is-invalid @enderror" required>
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
    $("#DataKartuKeluarga").addClass("active");

    let fstatus = $("#filter_status");
    function construct_query_string()
    {
        return "?fstatus=" + encodeURIComponent(fstatus.val());
    }

    function handle_filter_change()
    {
        window.location = construct_query_string();
    }

    fstatus.change(handle_filter_change);
</script>
@endsection

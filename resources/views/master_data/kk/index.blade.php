@extends('template.home')
@section('heading', 'Data Keluarga')
@section('page')
  <li class="breadcrumb-item active">Data Keluarga</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
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

@extends('template.home')
@section('heading', 'Data Hadits')
@section('page')
  <li class="breadcrumb-item active">Data Hadits</li>
@endsection
@section('content')

<?php
$has_siswa = false;
$user = Auth::user();
$allow_edit = in_array($user->role, ["orang_tua", "admin"]);
$add_title = "Tambah Data Hadits";

?>

<div class="col-md-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                @include('monitoring.rumah.search_bar')
            </div>
            <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Hadits</th>
                    <th>Keterangan</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hadits as $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $v->hadits }}</td>
                        <td>{{ $v->lu }}</td>
                        <td>{{ $v->created_by() }}</td>
                        <td>{{ fix_id_dt($v->created_at) }}</td>
                        <td>
                            @if ($allow_edit)
                            <form action="{{ route('monitoring.rumah.hadits.destroy', Crypt::encrypt($v->id)) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm mt-2"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                            </form>
                            @endif
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
                <h4 class="modal-title">Tambah Data Hadits</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('monitoring.rumah.hadits.store', Crypt::encrypt($fsiswa)) }}" method="post" enctype="multipart/form-data"> @csrf <div class="row">
                        <input type="hidden" name="fkelas" value="{{ Crypt::encrypt($fkelas) }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hadits">Hadits</label>
                                <input type="text" id="hadits" name="hadits" class="form-control @error('hadits') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label for="lu">Keterangan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="lul" name="lu" value="L" required>
                                    <label class="form-check-label" for="lul">
                                    Lancar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="luu" name="lu" value="U" required>
                                    <label class="form-check-label" for="luu">
                                    Ulang
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    $("#Monitoring").addClass("active");
    $("#liMonitoring").addClass("menu-open");
    $("#DataMonitoringRumah").addClass("active");

    let fkelas = $("#filter_kelas");
    let fsiswa = $("#filter_siswa");

    function construct_query_string(rel_siswa)
    {
        let ret = "?fkelas=" + encodeURIComponent(fkelas.val());

        if (fsiswa.val() && rel_siswa) {
            ret += "&fsiswa=" + encodeURIComponent(fsiswa.val());
        }
        return ret;
    }

    function handle_filter_change_kelas()
    {
        window.location = construct_query_string(false);
    }

    function handle_filter_change_siswa()
    {
        window.location = construct_query_string(true);
    }

    fkelas.change(handle_filter_change_kelas);
    fsiswa.change(handle_filter_change_siswa);
</script>
@endsection

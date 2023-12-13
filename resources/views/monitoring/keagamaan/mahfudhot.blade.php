@extends('template.home')
@section('heading', 'Data Mahfudhot')
@section('page')
  <li class="breadcrumb-item active">Data Mahfudhot</li>
@endsection
@section('content')

<?php
$has_siswa = false;
$user = Auth::user();
$allow_edit = in_array($user->role, ["guru", "admin"]);
$add_title = "Tambah Data Mahfudhot";
$tipe_monitoring = "mahfudhot";
?>

<div class="col-md-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                @include('monitoring.search_bar')
            </div>
            <table id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Mahfudhot</th>
                    <th>Keterangan</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahfudhot as $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $v->mahfudhot }}</td>
                        <td>{{ $v->lu }}</td>
                        <td>{{ $v->created_by() }}</td>
                        <td>{{ fix_id_dt($v->created_at) }}</td>
                        <td>
                            <form action="{{ route('monitoring.keagamaan.mahfudhot.destroy', Crypt::encrypt($v->id)) }}" method="post">
                                @if ($allow_edit)
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm mt-2"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                                @endif
                                <?php $feedback_by = $v->feedback_by(); ?>
                                @if ($user->role === "orang_tua" || $feedback_by)
                                    <?php
                                        if (empty($v->feedback))
                                            $class = "btn-secondary";
                                        else
                                            $class = "btn-success";
                                    ?>
                                    <a onclick="handle_user_feedback(this);" user-data-id="{{ $v->id }}"
                                        user-feedback-by="{{ e($feedback_by) }}" user-feedback="{{ e($v->feedback) }}"
                                        data-toggle="modal" data-target=".show-feedback" style="color: white; cursor: pointer;"
                                        class="btn {{ $class }} btn-sm mt-2">
                                        <i class="nav-icon fas fa-comment-alt"></i> &nbsp; Feedback
                                    </a>
                                @endif
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

@include('monitoring.user_feedback')

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Mahfudhot</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('monitoring.keagamaan.mahfudhot.store', Crypt::encrypt($fsiswa)) }}" method="post" enctype="multipart/form-data"> @csrf <div class="row">
                        <input type="hidden" name="fkelas" value="{{ Crypt::encrypt($fkelas) }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mahfudhot">Mahfudhot</label>
                                <input type="text" id="mahfudhot" name="mahfudhot" class="form-control @error('mahfudhot') is-invalid @enderror" required>
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
    $("#DataMonitoringKeagamaan").addClass("active");

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

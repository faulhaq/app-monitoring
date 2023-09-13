@extends('template.home')
@section('heading', 'Data Mahfudhot')
@section('page')
  <li class="breadcrumb-item active">Data Mahfudhot</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Mahfudhot
                </button>
            </h3>  
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="filter_kelas">Pilih Kelas</label>
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
                        <label for="filter_siswa">Pilih Siswa</label>
                        <select id="filter_siswa" name="filter_siswa" class="select2bs4 form-control">
                            <option value="">Pilih Siswa</option>
                        </select>
                    </div>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Mahfudhot</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                
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
                <h4 class="modal-title">Tambah Data MahfudhotSS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('monitoring.sekolah.mahfudhot.store') }}" method="post" enctype="multipart/form-data"> @csrf <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mahfudhot">Mahfudhot</label>
                                <input type="text" id="mahfudhot" name="mahfudhot" onkeypress="return inputAngka(event)" class="form-control @error('mahfudhot') is-invalid @enderror" required>
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
    $("#DataMonitoringSekolah").addClass("active");

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

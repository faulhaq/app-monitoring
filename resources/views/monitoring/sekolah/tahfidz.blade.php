@extends('template.home')
@section('heading', 'Data Tahfidz')
@section('page')
  <li class="breadcrumb-item active">Data Tahfidz</li>
@endsection
@section('content')

<?php
$has_siswa = false;
$user = Auth::user();
$allow_edit = in_array($user->role, ["guru", "admin"]);

?>

<div class="col-md-12">
    <div class="card">
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
                            @foreach ($siswa as $v)
                                <?php $sel = $v->id == $fsiswa ? " selected" : ""; ?>
                                <?php if ($v->id == $fsiswa) $has_siswa = true; ?>
                                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if ($has_siswa)
                    <div class="col-md" style="margin-bottom: 10px;">
                        <div class="card-header">
                            <?php $kelas = $sel_siswa->kelas(); ?>
                            <?php $wali_kelas = $kelas->wali_kelas(); ?>
                            <h5 class="card-title card-text mb-2">Nama Siswa : {{ $sel_siswa->nama }}</h5>
                            <h5 class="card-title card-text mb-2">Kelas : {{ $kelas->tingkatan.$kelas->nama }}</h5>
                            <h5 class="card-title card-text mb-2">Wali Kelas : {{ " (NIP : {$wali_kelas->nip}) {$wali_kelas->nama}" }}</h5>
                        </div>
                        @if ($allow_edit)
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Tahfidz
                                </button>
                            </h3>
                        </div>
                        @endif
                    </div>
                @endif
            </div>
            <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Surah</th>
                    <th>Ayat</th>
                    <th>Keterangan</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tahfidz as $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $v->surah() }}</td>
                        <td>{{ $v->ayat }}</td>
                        <td>{{ $v->lu }}</td>
                        <td>{{ $v->created_by() }}</td>
                        <td>{{ fix_id_dt($v->created_at) }}</td>
                        <td>
                            @if ($allow_edit)
                            <form action="{{ route('monitoring.sekolah.tahfidz.destroy', Crypt::encrypt($v->id)) }}" method="post">
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

@if ($has_siswa)
<!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Tahfidz</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('monitoring.sekolah.tahfidz.store', Crypt::encrypt($fsiswa)) }}" method="post" enctype="multipart/form-data"> @csrf <div class="row">
                        <input type="hidden" name="fkelas" value="{{ Crypt::encrypt($fkelas) }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="surah">Surah</label>
                                <select id="surah" name="surah" class="form-control @error('surah') is-invalid @enderror" required>
                                    <option value="">-- Pilih Surah ---</option>
                                    @foreach (\App\Models\Ref\Surah::all() as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="ayat">Ayat</label>
                                <input type="text" id="ayat" name="ayat" class="form-control @error('ayat') is-invalid @enderror" required>
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
@endif

@endsection
@section('script')
<script>
    $("#Monitoring").addClass("active");
    $("#liMonitoring").addClass("menu-open");
    $("#DataMonitoringSekolah").addClass("active");

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

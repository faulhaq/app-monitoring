@extends('template.home')
@section('heading', 'Data Hadits')
@section('page')
  <li class="breadcrumb-item active">Data Hadits</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <?php /* @include('monitoring.search_bar') */ ?>
                <div class="col-md">
                    <div class="form-group">
                        <label for="filter_siswa">Pilih Siswa</label>
                        <select id="filter_siswa" name="filter_siswa" class="select2bs4 form-control">
                            @if (count($siswa) > 1)
                                <option value="">-- Pilih Siswa --</option>
                            @endif
                            @foreach ($siswa as $s)
                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ $ftanggal }}" class="form-control @error('tanggal') is-invalid @enderror" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('monitoring.harian.simpan_jawaban') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <h3>Isian</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($harian as $v)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $v->pertanyaan }}</td>
                                    <td><textarea name="jawaban_{{ $v->id }}" class="form-control @error('pertanyaan') is-invalid @enderror">{{ $v->jawaban }}</textarea></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <button class="btn btn-primary">Simpan Jawaban</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
</div>

<?php /* @include('monitoring.user_feedback') */ ?>

<?php /*
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
                <form action="{{ route('monitoring.keagamaan.hadits.store', Crypt::encrypt($fsiswa)) }}" method="post" enctype="multipart/form-data"> @csrf <div class="row">
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
*/
?>

@endsection
@section('script')
<script>
    $("#Monitoring").addClass("active");
    $("#liMonitoring").addClass("menu-open");
    $("#DataMonitoringHarian").addClass("active");

    let ftanggal = $("#tanggal");

    function reload_page()
    {
        let url = "";

        url += "?ftanggal=" + ftanggal[0].value;

        window.location = url;
    }

    ftanggal[0].addEventListener("change", function () {
        reload_page();
    });

</script>
@endsection

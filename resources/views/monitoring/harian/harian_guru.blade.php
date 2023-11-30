@extends('template.home')
@section('heading', 'Data Hadits')
@section('page')
  <li class="breadcrumb-item active">Data Hadits</li>
@endsection
@section('content')
<?php
if (strtotime($ftanggal) > time()) {
    $disable_j = " disabled";
} else {
    $disable_j = "";
}
$user = Auth::user();
$has_siswa = false;
?>
<div class="col-md-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                @include('monitoring.search_bar')
                <div class="col-md">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ $ftanggal }}" class="form-control @error('tanggal') is-invalid @enderror" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('monitoring.harian.simpan_jawaban') }}" method="POST">
        <div class="card">
            @csrf
            @if ($sel_siswa)
            <input type="hidden" name="id_siswa" value="{{ $sel_siswa->id }}"/>
            <input type="hidden" name="tanggal" value="{{ $ftanggal }}"/>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <h3>Pilihan</h3>
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
                            @foreach($harian_yn as $v)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $v["p"]->pertanyaan }}</td>
                                    <td><?php
                                        if (isset($v["j"]->jawaban)) {
                                            if ($v["j"]->jawaban === "y") {
                                                echo "Ya";
                                            } else {
                                                echo "Tidak";
                                            }
                                        }
                                    ?></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            @csrf
            @if ($sel_siswa)
            <input type="hidden" name="id_siswa" value="{{ $sel_siswa->id }}"/>
            <input type="hidden" name="tanggal" value="{{ $ftanggal }}"/>
            @endif
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
                            @foreach($harian_isian as $v)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $v["p"]->pertanyaan }}</td>
                                    <td>{{ $v["j"]->jawaban ?? "" }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php /* @include('monitoring.user_feedback') */ ?>


@endsection
@section('script')
<script>
    $("#Monitoring").addClass("active");
    $("#liMonitoring").addClass("menu-open");
    $("#DataMonitoringHarian").addClass("active");

    let ftanggal = $("#tanggal");
    let fsiswa = $("#filter_siswa");
    let fkelas = $("#filter_kelas");
    function reload_page()
    {
        let url = "";

        url += "?ftanggal=" + ftanggal[0].value;
        url += "&fsiswa=" + fsiswa[0].value;
        url += "&fkelas=" + fkelas[0].value;

        window.location = url;
    }

    ftanggal.change(function () {
        reload_page();
    });
    fsiswa.change(function () {
        reload_page();
    });
    fkelas.change(function () {
        fsiswa[0].value = "";
        reload_page();
    });
</script>
@endsection

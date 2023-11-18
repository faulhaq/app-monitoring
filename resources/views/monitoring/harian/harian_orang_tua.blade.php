@extends('template.home')
@section('heading', 'Data Monitoring Harian')
@section('page')
  <li class="breadcrumb-item active">Data Monitoring Harian</li>
@endsection
@section('content')
<?php
if (strtotime($ftanggal) > time()) {
    $disable_j = " disabled";
} else {
    $disable_j = "";
}
$user = Auth::user();
?>
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
                            @foreach ($siswa as $s)
                                <?php $sel = ($s->id === $sel_siswa->id) ? " selected" : ""; ?>
                                <option value="{{ $s->id }}"{!! $sel !!}>{{ $s->nama }}</option>
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

    <form action="{{ route('monitoring.harian.simpan_jawaban') }}" method="POST">
        <div class="card">
            @csrf
            <input type="hidden" name="id_siswa" value="{{ $fsiswa->id }}"/>
            <input type="hidden" name="tanggal" value="{{ $ftanggal }}"/>
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
                                <?php
                                    $ncheck = "";
                                    $ycheck = "";
                                    if (!empty($v["j"]->jawaban)) {
                                        $c = " checked";
                                        if ($v["j"]->jawaban === "y") {
                                            $ycheck = $c;
                                        } else {
                                            $ncheck = $c;
                                        }
                                    }
                                ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $v["p"]->pertanyaan }}</td>
                                    <td>
                                        <input type="radio" name="jawaban[hy_{{ $v['p']->id }}]" value="y"{!! $ycheck !!}/> Ya
                                        &nbsp;
                                        <input type="radio" name="jawaban[hy_{{ $v['p']->id }}]" value="n"{!! $ncheck !!}/> Tidak
                                    </td>
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
            <input type="hidden" name="id_siswa" value="{{ $fsiswa->id }}"/>
            <input type="hidden" name="tanggal" value="{{ $ftanggal }}"/>
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
                                    <td><textarea name="jawaban[hi_{{ $v['p']->id }}]" class="form-control @error('pertanyaan') is-invalid @enderror" {!! $disable_j !!}>{{ $v["j"]->jawaban ?? "" }}</textarea></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <button style="margin-bottom: 30px; float: right;" class="btn btn-primary" {!! $disable_j !!}>Simpan Jawaban</button>

   
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
    function reload_page()
    {
        let url = "";

        url += "?ftanggal=" + ftanggal[0].value;
        url += "&fsiswa=" + fsiswa[0].value;

        window.location = url;
    }

    ftanggal.change(function () {
        reload_page();
    });
    fsiswa.change(function () {
        reload_page();
    });

</script>
@endsection

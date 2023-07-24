@extends('template_backend.home')
@section('heading')
  Data Anak
@endsection
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('orang_tua.index') }}">Siswa</a></li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
        <div class="col-md-2">
            <div class="form-group">
                <label for="tgl_history">Tanggal</label>
                <input type="date" id="tgl_history" name="tgl_history" value="{{ $tanggal }}" class="form-control @error('tgl_history') is-invalid @enderror">
            </div>
        </div>
            <form action="{{ route('orang_tua.monitoring.simpan', $id_siswa_encrypted) }}" method="POST">
                @csrf
                <h1>Y/N</h1>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach ($per_yn as $v)
                        <?php $v->data = json_decode($v->data, false); ?>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $v->data->q }}</td>
                            <td>{{ $v->jawaban === "y" ? "Ya" : "Tidak" }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h1>Isian</h1>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach ($per_isian as $v)
                        <?php $v->data = json_decode($v->data, false); ?>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $v->data->q }}</td>
                            <td>{{ $v->jawaban }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('orang_tua.monitoring', $id_siswa_encrypted) . '?back=show_anak' }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataOrangTua").addClass("active");
        $('[type="date"]').change(function() {
            window.location = "?tanggal=" + $(this).val();
        });
    </script>
@endsection

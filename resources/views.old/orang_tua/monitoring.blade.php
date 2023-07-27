@extends('template_backend.home')
@section('heading')
  Data Monitoring Untuk Tanggal {{ date("d F Y") }}
@endsection
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('orang_tua.index') }}">Siswa</a></li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('orang_tua.monitoring.simpan', $id_siswa_encrypted) }}" method="POST">
                @csrf
                <h1>Pilih Ya atau Tidak</h1>
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
                            <td>
                                <input type="radio" name="yn[{{$v->id_monitoring}}]" value="y"<?= $v->jawaban === "y" ? " checked" : "" ?>/> Ya<br/>
                                <input type="radio" name="yn[{{$v->id_monitoring}}]" value="n"<?= $v->jawaban === "n" ? " checked" : "" ?>/> Tidak
                            </td>
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
                            <td>
                                <textarea name="isian[{{$v->id_monitoring}}]">{{ $v->jawaban }}</textarea>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('orang_tua.show_anak') }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('orang_tua.show_history_monitoring', $id_siswa_encrypted) }}"><button type="button" style="float:right" class="btn btn-primary">History</button></a>
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
    </script>
@endsection

@extends('template.home')
@section('heading', 'Data Tahun Ajaran')
@section('page')
    <li class="breadcrumb-item active">Data Tahun Ajaran</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                        data-target=".bd-example-modal-lg">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Tahun Ajaran
                    </button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                        data-target=".modal-set-aktif">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Ubah Tahun Aktif
                    </button>
                </h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-responsive-md">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tahun_ajaran as $v)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $v->tahun }}</td>
                                <td>{{ $v->status() }}</td>
                                <td>{{ fix_id_dt($v->created_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <!-- Extra large modal -->
    <div class="modal fade modal-set-aktif" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Tahun Aktif</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tahun_ajaran.aktifkan_tahun') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tahun">Tahun Ajaran</label>
                                    <select id="tahun" name="tahun"
                                        class="select2bs4 form-control @error('tahun') is-invalid @enderror">
                                        <option value="">-- Pilih Tahun Ajaran --</option>
                                        @foreach ($tahun_ajaran as $v)
                                            <?php $sel = $v->status() === 'Aktif' ? ' selected' : ''; ?>
                                            <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                    <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                        Aktifkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra large modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Tahun Ajaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tahun_ajaran.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="tahun">Tahun Ajaran</label>
                                    <select id="tahun" name="tahun"
                                        class="select2bs4 form-control @error('tahun') is-invalid @enderror">
                                        <option value="">-- Pilih Tahun Ajaran --</option>
                                        @for ($i = 2022; $i <= 2100; $i++)
                                            <?= $j = $i . '/' . ($i + 1) ?>
                                            <option value="{{ $j }}">{{ $j }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                    <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                        Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataTahunAjaran").addClass("active");
    </script>
@endsection

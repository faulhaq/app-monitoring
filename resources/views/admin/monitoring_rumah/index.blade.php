@extends('template_backend.home')
@section('heading', 'Data Monitoring Rumah')
@section('page')
  <li class="breadcrumb-item active">Data Monitoring Rumah</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-monitoring-rumah">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Monitoring Rumah
                </button>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipe</th>
                    <th>Data</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($monitoring as $d)
            <?php
                $data = json_decode($d->data, true);
                $data = $data["q"] ?? "";
            ?>
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->tipe }}</td>
                    <td>{{ $data }}</td>
                    <td>{{ $d->created_by ? $d->created_by : "Admin" }}</td>
                    <td>{{ date("d F Y H:i:s", strtotime($d->created_at)) }}</td>
                    <td>
                        <form action="{{ route('monitoring_rumah.destroy', Crypt::encrypt($d->id)) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('monitoring_rumah.edit', Crypt::encrypt($d->id)) }}">
                            <button type="button" class="btn btn-success btn-sm">
                              <i class="nav-icon fas fa-edit"></i> &nbsp; Edit
                            </button>
                            </a>
                            <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-md tambah-monitoring-rumah" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Tambah Monitoring Rumah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{ route('monitoring_rumah.store') }}" method="post">
          @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="tipe">Tipe</label>
                  <select id="tipe" class="form-control @error('tipe') is-invalid @enderror select2bs4" name="tipe" value="{{ old('tipe') }}" autocomplete="tipe">
                    <option value="">-- Select {{ __('Tipe') }} --</option>
                    <option value="yes_no">Yes/No</option>
                    <option value="isian">Isian</option>
                  </select>
                  @error('role')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group" id="noId">
                </div>
                <div class="form-group">
                  <label for="pertanyaan">Pertanyaan</label>
                  <input id="pertanyaan" type="text" placeholder="{{ __('Pertanyaan') }}" class="form-control @error('pertanyaan') is-invalid @enderror" name="data" autocomplete="pertanyaan">
                  @error('pertanyaan')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="pertanyaan">Tujuan Kelas</label>

                  @foreach ($kelas as $v)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tujuan_kelas[]" value="{{ $v->id }}"/>
                    <label class="form-check-label" for="flexCheckDefault">{{ $v->nama_kelas }}</label>
                  </div>
                  @endforeach
                  
                  @error('pertanyaan')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
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
        $("#DataMonitoringRumah").addClass("active");
    </script>
@endsection
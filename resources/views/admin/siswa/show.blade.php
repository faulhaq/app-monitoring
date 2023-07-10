@extends('template_backend.home')
@section('heading')
  Data Siswa <?= isset($kelas) ? $kelas->nama_kelas : ""; ?>
@endsection
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></li>
  @if (isset($kelas))
  <li class="breadcrumb-item active">{{ $kelas->nama_kelas }}</li>
  @endif
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>NIK</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>
                            <a href="{{ asset($data->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->nama }}" data-gallery="gallery" data-footer='<a href="{{ route('siswa.ubah-foto', Crypt::encrypt($data->id)) }}" id="linkFotoGuru" class="btn btn-link btn-block btn-light"><i class="nav-icon fas fa-file-upload"></i> &nbsp; Ubah Foto</a>'>
                                <img src="{{ asset($data->foto) }}" width="130px" class="img-fluid mb-2">
                            </a>
                            {{-- https://siakad.didev.id/siswa/ubah-foto/{{$data->id}} --}}
                        </td>
                        <td>
                            <form action="{{ route('siswa.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('siswa.show', Crypt::encrypt($data->id)) }}" class="btn btn-info btn-sm mt-2"><i class="nav-icon fas fa-id-card"></i> &nbsp; Detail</a>
                                <a href="{{ route('siswa.edit', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                <button class="btn btn-danger btn-sm mt-2"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
<?php
    $back_link = (Auth::user()->role === "OrangTua") ? route('home') : route('siswa.index');
?>
            <a href="{{ $back_link }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </div>
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataSiswa").addClass("active");
    </script>
@endsection
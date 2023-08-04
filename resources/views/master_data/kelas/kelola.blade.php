@extends('template.home')
@section('heading', 'Data Kelas')
@section('page')
  <li class="breadcrumb-item active">Data Kelas</li>
@endsection
@section('content')
<?php
$enc_id_kelas = Crypt::encrypt($kelas->id);
?>
<div class="col-md-12">
    <div class="card">
      <div class="row" style="padding: 30px">
        <div class="col-md">
          <h3>Detail Kelas</h3>
          <table>
            <tbody>
              <tr><td>Nama Kelas</td><td>:</td><td>{{ $kelas->tingkatan.$kelas->nama }}</td></tr>
              <tr><td>Wali Kelas</td><td>:</td><td>{{ $kelas->wali_kelas()->nama }}</td></tr>
              <tr><td>Tahun Ajaran</td><td>:</td><td>{{ $kelas->tahun_ajaran()->tahun }}</td></tr>
              <tr><td>Jumlah Siswa</td><td>:</td><td>{{ $kelas->jumlah_siswa() }}</td></tr>
              <tr><td><button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Siswa</button></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row" style="padding: 30px;">
        <div class="col-md">
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($siswa as $v)
                <tr>
                  <td>{{ $v->id }}</td>
                  <td>{{ $v->nik }}</td>
                  <td>{{ $v->nis }}</td>
                  <td>{{ $v->nama }}</td>
                  <td>
                    <?php $enc_id_siswa = Crypt::encrypt($v->id); ?>
                    <form action="{{ route('kelas.hapus_siswa', [$enc_id_kelas, $enc_id_siswa]) }}" method="post">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm mt-2"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Siswa ke Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kelas.kelola.tambah_siswa', $enc_id_kelas) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="fg_siswa">
                                <div style="margin-top: 10px">
                                    <select name="id_siswa[]" class="form-control">
                                        <option value="">-- Pilih Siswa --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                        <button id="tambah_siswa_btn" type="button" class="btn btn-primary">Tambah Siswa</button>
                        <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
                    </div>
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
$("#DataKelas").addClass("active");
$("#tambah_siswa_btn").click(function () {
    $("#fg_siswa")[0].innerHTML +=
        '<div style="margin-top: 10px">' +
            '<select name="id_siswa[]" class="form-control">' +
                '<option value="">-- Pilih Siswa --</option>' +
            '</select>' +
        '</div>';
});
</script>
@endsection

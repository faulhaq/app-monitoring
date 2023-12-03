@extends('template.home')
@section('heading', 'Kelola Kelas')
@section('page')
  <li class="breadcrumb-item active">Kelola Kelas</li>
@endsection
@section('content')
<?php
$enc_id_kelas = Crypt::encrypt($kelas->id);
$user = Auth::user();
$role = $user->role;
$id_guru = $user->id_guru;
?>

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Detail Kelas</h3>
        </div>
        <div class="card-body">
            <div class="row" style="padding: 30px">
                <div class="col-md">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nama Kelas</td>
                                <td>:</td>
                                <td>{{ $kelas->tingkatan.$kelas->nama }}</td>
                            </tr>
                            <tr>
                                <td>Wali Kelas</td>
                                <td>:</td>
                                <td>{{ $kelas->wali_kelas()->nama }}</td>
                            </tr>
                            <tr>
                                <td>Tahun Ajaran</td>
                                <td>:</td>
                                <td>{{ $kelas->tahun_ajaran()->tahun }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Siswa</td>
                                <td>:</td>
                                <td>{{ $kelas->jumlah_siswa() }}</td>
                            </tr> @if ($role === "admin") <tr>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Siswa</button>
                                </td>
                            </tr> @endif
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
                                <td> <?php $enc_id_siswa = Crypt::encrypt($v->id); ?> <form action="{{ route('kelas.hapus_siswa', [$enc_id_kelas, $enc_id_siswa]) }}" method="post"> @csrf @method('delete') @if ($role === "admin") <button class="btn btn-danger btn-sm mt-2">
                                            <i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus </button> @endif <a href="{{ route('monitoring.keagamaan.tahsin').'?fkelas='.$kelas->id.'&fsiswa='.$v->id }}" class="btn btn-danger btn-sm mt-2">
                                            <i class="nav-icon fas fa-clipboard"></i> &nbsp; Tahsin </a>
                                        <a href="{{ route('monitoring.keagamaan.tahfidz').'?fkelas='.$kelas->id.'&fsiswa='.$v->id }}" class="btn btn-danger btn-sm mt-2">
                                            <i class="nav-icon fas fa-clipboard"></i> &nbsp; Tahfidz </a>
                                        <a href="{{ route('monitoring.keagamaan.mahfudhot').'?fkelas='.$kelas->id.'&fsiswa='.$v->id }}" class="btn btn-danger btn-sm mt-2">
                                            <i class="nav-icon fas fa-clipboard"></i> &nbsp; Mahfudhot </a>
                                        <a href="{{ route('monitoring.keagamaan.hadits').'?fkelas='.$kelas->id.'&fsiswa='.$v->id }}" class="btn btn-danger btn-sm mt-2">
                                            <i class="nav-icon fas fa-clipboard"></i> &nbsp; Hadits </a>
                                        <a href="{{ route('monitoring.keagamaan.doa').'?fkelas='.$kelas->id.'&fsiswa='.$v->id }}" class="btn btn-danger btn-sm mt-2">
                                            <i class="nav-icon fas fa-clipboard"></i> &nbsp; Doa </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer">
                        <a href="{{ route('kelas.index') }}" name="kembali" class="btn btn-default" id="back">
                            <i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali </a> &nbsp;
                    </div>
                </div>
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
                                    <select name="id_siswa[]" id="list-siswa-1" class="form-control list-siswa">
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
let list_siswa_no_kelas = [];
let siswa_selected = {};
let fg_siswa = $("#fg_siswa");
let select_count = 1;

function collect_selected_siswa()
{
  siswa_selected = {};
  $(".list-siswa").each(function (k, v) {
    v = $(v).val();
    if (v == "")
      return;
    v = "x" + v;
    siswa_selected[v] = 1;
  });
  console.log("collect", siswa_selected);
}

function construct_all_select_inputs()
{
  let r = "";
  let i, k = 1, j = select_count;

  for (i in siswa_selected) {
    let id = i.substr(1);
    r += construct_siswa_select(k++, id);
    j--;
  }

  while (j--) {
    r += construct_siswa_select(k++);
  }
  fg_siswa[0].innerHTML = r;
  set_event_siswa();
}

function set_event_siswa()
{
  $(".list-siswa").change(function (e) {
      collect_selected_siswa();
      construct_all_select_inputs();
  });
}

function create_select_input(id, k)
{
}

function construct_siswa_options(sel_id = null)
{
    let arr = list_siswa_no_kelas;
    let i, r = `<option value="">-- Pilih Siswa --</option>`;

    for (i in arr) {
        let v = arr[i];
        if (sel_id === null && typeof siswa_selected["x" + v.id] != "undefined") {
          continue;
        }

        if (sel_id !== null && typeof siswa_selected["x" + v.id] != "undefined" && sel_id != v.id) {
          continue;
        }

        let sel = (v.id == sel_id) ? " selected" : "";
        r += `<option value="${v.id}"${sel}>(NIS: ${v.nis}) ${v.nama}</option>`;
    }
    return r;
}

function construct_siswa_select(i, sel_id = null)
{
    console.log(i, sel_id);
    return `<div style="margin-top: 10px">` +
              `<select name="id_siswa[]" id="list-siswa-${i}" class="form-control list-siswa">` +
              construct_siswa_options(sel_id) +
              `</select>` +
            `</div>`;
}

$("#MasterData").addClass("active");
$("#liMasterData").addClass("menu-open");
$("#DataKelas").addClass("active");
$("#tambah_siswa_btn").click(function () {
    select_count++
    construct_all_select_inputs();
});
$.ajax({
    url: "{{ route('siswa.get_siswa_no_kelas', $enc_id_kelas) }}",
    method: "GET",
    success: function (data) {
        list_siswa_no_kelas = data;
        fg_siswa[0].innerHTML = construct_siswa_select(1);
        set_event_siswa();
    }
});
set_event_siswa();
</script>
@endsection

@extends('template.home')
@section('heading', 'Data User')
@section('page')
  <li class="breadcrumb-item active">Data User</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data User
                </button>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $v)
                <?php
                    $role = $v->role;
                    if ($role === "orang_tua")
                        $role = "Orang Tua";
                    else if ($role === "admin")
                        $role = "Admin";
                    else if ($role === "guru")
                        $role = "Guru";
                ?>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $v->nama() }}</td>
                    <td>{{ $role }}</td>
                    <td>{{ $v->email }}</td>
                    <td>
                        <?php $enc_id = Crypt::encrypt($v->id); ?>
                        <form action="{{ route('user.destroy', $enc_id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('user.show', $enc_id) }}" class="btn btn-info btn-sm mt-2"><i class="nav-icon fas fa-id-card"></i> &nbsp; Detail</a>
                            <a href="{{ route('user.edit', $enc_id) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                            @if ($v->id != 1)
                            <button class="btn btn-danger btn-sm mt-2"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" class="select2bs4 form-control @error('role') is-invalid @enderror" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="guru">Guru</option>
                            <option value="orang_tua">Orang Tua</option>
                        </select>
                    </div>
                    <div class="form-group" id="list_user_fg" style="display: none">
                        <label for="list_user" id="list_user_label"></label>
                        <select id="list_user" name="id_fk_user" class="select2bs4 form-control @error('id_fk_user') is-invalid @enderror" required>
                        </select>
                    </div>
                    <div class="form-group" id="email_fg" style="display: none">
                        <label for="email">Email</label>
                        <input autocomplete="off" type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" disabled>
                    </div>
                    <div class="form-group" id="password_fg" style="display: none">
                        <label for="password">Password</label>
                        <input autocomplete="off" type="text" value="{{ $gen_pass }}" id="password" name="password" class="form-control @error('password') is-invalid @enderror" readonly required>
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
$("#DataUser").addClass("active");

let fetched_data = [];
let current_role = "";
let efg = $("#email_fg");
let pfg = $("#password_fg");
let ei = $("#email");
let pi = $("#password");

function find_field_by_id(id, field)
{
    let i;
    let data = fetched_data;

    for (i = 0; i < data.length; i++) {
        if (data[i].id == id) {
            return data[i][field];
        }
    }

    return null;
}

function fill_user(data, label)
{
    let i, r = "";

    $("#list_user_fg").show();
    $("#list_user_label").html(label);
    data = data.data;
    fetched_data = data;
    r += `<option value="">-- ${label} --</option>`;
    for (i = 0; i < data.length; i++) {
        let v = data[i];
        r += `<option value="${v.id}">(NIK: ${v.nik}) - ${v.nama}</option>`;
    }
    $("#list_user").html(r);
}

function get_list_orang_tua()
{
    current_role = "orang_tua";
    $.ajax({
        url: "{{ route('orang_tua.get_list') }}",
        success: function (data) {
            fill_user(data, "Pilih Orang Tua");
        }
    });
}

function get_list_guru()
{
    current_role = "guru";
    $.ajax({
        url: "{{ route('guru.get_list') }}",
        success: function (data) {
            fill_user(data, "Pilih Guru");
        }
    });
}

$("#role").change(function () {
    let role = $(this).val();
    $("#list_user_fg").hide();
    $("#email").val("");
    $("#password").val("{{ $gen_pass }}");
    efg.hide();
    pfg.hide();
    switch (role) {
    case "orang_tua":
        get_list_orang_tua();
        ei[0].disabled = true;
        break;
    case "guru":
        get_list_guru();
        ei[0].disabled = true;
        break;
    case "admin":
        current_role = "admin";
        efg.show();
        pfg.show();
        ei[0].disabled = false;
        $("#list_user").removeAttr("required");
        break;
    }
});

pi.val("{{ $gen_pass }}");

$("#list_user").change(function () {
    let id = $(this).val();
    let email = find_field_by_id(id, "email");
    efg.show();
    $("#email").val(email);
    pfg.show();
});

</script>
@endsection

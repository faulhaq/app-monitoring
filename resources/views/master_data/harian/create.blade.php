@extends('template.home')
@section('heading', 'Tambah Data Harian')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('harian.index') }}">Data Harian</a></li>
  <li class="breadcrumb-item active">Tambah Data Harian</li>
@endsection
@section('content')

<div class="col-md-12">
    <form action="{{ route('harian.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Harian</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="tujuan_kelas">Tujuan Kelas</label>
                        <select id="tujuan_kelas" name="tujuan_kelas" class="select2bs4 form-control @error('tujuan_kelas') is-invalid @enderror" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach (App\Models\Master\Kelas::get_kelas_aktif() as $k)
                                <?php
                                if (isset($fkelas)) {
                                    $sel = ($fkelas == $k->id) ? " selected" : "";
                                } else {
                                    $sel = "";
                                }
                                ?>
                                <option value="{{ $k->id }}"{!! $sel !!}>{{ $k->nama_kelas() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @if (!empty($list_tahun))
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select id="tahun" name="tahun" class="select2bs4 form-control @error('tahun') is-invalid @enderror" required>
                            <option value="">-- Pilih Tahun --</option>
                            @foreach ($list_tahun as $v)
                                <?php
                                if (isset($ftahun)) {
                                    $sel = ($ftahun == $v) ? " selected" : "";
                                } else {
                                    $sel = "";
                                }
                                ?>
                                <option value="{{ $v }}"{!! $sel !!}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @endif

            @if (!empty($list_bulan))
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select id="bulan" name="bulan" class="select2bs4 form-control @error('bulan') is-invalid @enderror" required>
                            <option value="">-- Pilih bulan --</option>
                            @foreach ($list_bulan as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if (!empty($ftahun))
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Pertanyaan Data Harian</h3>
        </div>
        <div class="card-body">
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-md">
                    <button id="tambah_pertanyaan" class="btn btn-success">Tambah Pertanyaan</button>
                </div>
            </div>

            <div id="cage-form">
            </div>
            <div class="card-footer">
                <a href="{{ route('harian.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
            </div>
        </div>
    </div>
    @endif
    </form>
</div>

<div id="input_template" style="display: none;">
    <div class="row" id="row_xxiii">
        <div class="col-md-8">
            <div class="form-group">
                <label for="pertanyaan_xxiii">Pertanyaan xxiii</label>
                <textarea class="form-control @error('pertanyaan_xxiii') is-invalid @enderror" name="pertanyaan[xxiii]" id="pertanyaan_xxiii"></textarea>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="jenis_pertanyaan_xxiii">Jenis Pertanyaan xxiii</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="jenis_pertanyaan_i_xxiii" name="jenis_pertanyaan[xxiii]" value="isian">
                    <label class="form-check-label" for="jenis_pertanyaan_i_xxiii">
                    Isian
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="jenis_pertanyaan_o_xxiii" name="jenis_pertanyaan[xxiii]" value="opsi">
                    <label class="form-check-label" for="jenis_pertanyaan_o_xxiii">
                    Opsi
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" style="margin-top: 35px;" class="btn btn-danger" onclick="del_pertanyaan(this, xxiii)">Hapus</button>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataHarian").addClass("active");

    let cf = $("#cage-form");
    let qcounter = 0;
    let form_state = {};

    let fkelas = $("#tujuan_kelas");
@if (!empty($list_tahun))
    let ftahun = $("#tahun");
@endif

    function apply_url()
    {
        let url = "";

        url += "?fkelas=" + fkelas[0].value;

        @if (!empty($list_tahun))
            url += "&ftahun=" + ftahun[0].value;
        @endif

        window.location = url;
    }

    fkelas.change(function (e) { apply_url(); });
@if (!empty($list_tahun))
    ftahun.change(function (e) { apply_url(); });
@endif

    function collect_form_state()
    {
        let i;

        form_state = {};
        for (i = 1; i <= qcounter; i++) {
            if (!document.getElementById("pertanyaan_" + i)) {
                continue;
            }
            form_state[i] = [
                $("#pertanyaan_" + i).val(),
                $("#jenis_pertanyaan_i_" + i)[0].checked,
                $("#jenis_pertanyaan_o_" + i)[0].checked
            ];
        }
    }

    function build_form_from_state()
    {
        let template = input_template.innerHTML;
        let new_form_state = {};
        let new_qcounter = 0;
        let i, j;
        let r = "";

        j = 1;
        for (i in form_state) {
            r += template.replace(/xxiii/g, j);
            new_form_state[j] = form_state[i];
            new_qcounter++;
            j++;
        }

        cf[0].innerHTML = r;

        form_state = new_form_state;
        for (i = 1; i <= qcounter; i++) {
            $("#pertanyaan_" + i).val(form_state[i][0]);

            if (form_state[i][1]) {
                $("#jenis_pertanyaan_i_" + i)[0].checked = true;
            } else if (form_state[i][2]) {
                $("#jenis_pertanyaan_o_" + i)[0].checked = true;
            }
        }
        qcounter = new_qcounter;
    }

    $("#tambah_pertanyaan").click(function (e) {
        e.preventDefault();
        collect_form_state();
        form_state[++qcounter] = ["", false, false];
        build_form_from_state();
    });

    function del_pertanyaan(e, i)
    {
        collect_form_state();
        delete form_state[i];
        qcounter--;
        build_form_from_state();
    }
</script>
@endsection

@extends('template.home')
@section('heading', 'Edit Pertanyaan Data Harian')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('harian.index') }}">Data Harian</a></li>
  <li class="breadcrumb-item active">Edit Pertanyaan Data Harian</li>
@endsection
@section('content')

<div class="col-md-12">
    <form action="{{ route('harian.update', Crypt::encrypt($harian->id)) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Pertanyaan Data Harian</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="kelas" name="kelas" class="form-control @error('kelas') is-invalid @enderror" readonly="1" value="{{ $harian->kelas->nama_kelas() }}"/>
                        <input type="hidden" name="tujuan_kelas" value="{{ $harian->kelas->id }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input id="tahun" name="tahun" class="form-control @error('tahun') is-invalid @enderror" readonly="1" value="{{ $harian->tahun }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="fbulan">Bulan</label>
                        <input id="fbulan" name="fbulan" class="form-control @error('fbulan') is-invalid @enderror" readonly="1" value="{{ $harian->bulan() }}">
                        <input type="hidden" name="bulan" value="{{ $harian->bulan }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <?php $qcounter = 1; ?>
                @foreach ($pertanyaan as $p)
                    <?php
                        if ($p->tipe === "opsi") {
                            $sel_opsi = " checked";
                            $sel_isian = "";
                        } else {
                            $sel_opsi = "";
                            $sel_isian = " checked";
                        }

                    ?>
                    <div class="row" id="row_{{ $qcounter }}">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="pertanyaan_{{ $qcounter }}">Pertanyaan {{ $qcounter }}</label>
                                <textarea class="form-control @error('pertanyaan_{{ $qcounter }}') is-invalid @enderror" name="pertanyaan[{{ $qcounter }}]" id="pertanyaan_{{ $qcounter }}">{{ $p->pertanyaan }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jenis_pertanyaan_{{ $qcounter }}">Jenis Pertanyaan {{ $qcounter }}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jenis_pertanyaan_i_{{ $qcounter }}" name="jenis_pertanyaan[{{ $qcounter }}]" value="isian"{!! $sel_isian !!}>
                                    <label class="form-check-label" for="jenis_pertanyaan_i_{{ $qcounter }}">
                                    Isian
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jenis_pertanyaan_o_{{ $qcounter }}" name="jenis_pertanyaan[{{ $qcounter }}]" value="opsi"{!! $sel_opsi !!}>
                                    <label class="form-check-label" for="jenis_pertanyaan_o_{{ $qcounter }}">
                                    Opsi
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" style="margin-top: 35px;" class="btn btn-danger" onclick="del_pertanyaan(this, {{ $qcounter }})">Hapus</button>
                        </div>
                    </div>
                <?php $qcounter++; ?>
                @endforeach
            </div>
            <div class="card-footer">
                <a href="{{ route('harian.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
            </div>
        </div>
    </div>
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
    let qcounter = <?= $qcounter - 1 ?>;
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

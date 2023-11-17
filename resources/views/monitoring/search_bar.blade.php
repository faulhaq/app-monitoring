
@if (!is_null($kelas))
<div class="col-md-6">
    <div class="form-group">
        <label for="filter_kelas">Pilih Kelas</label>
        <select id="filter_kelas" name="filter_kelas" class="select2bs4 form-control">
            <option value="all">Semua Kelas</option>
            @foreach ($kelas as $v)
                <?php $ta = $v->tahun_ajaran(); ?>
                @if ($ta->id == $id_tahun_ajaran_aktif)
                <?php $sel = $v->id == $fkelas ? " selected" : ""; ?>
                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->tingkatan.$v->nama." (TA: {$ta->tahun})" }} (aktif)</option>
                @endif
            @endforeach
            @foreach ($kelas as $v)
                <?php $ta = $v->tahun_ajaran(); ?>
                @if ($ta->id != $id_tahun_ajaran_aktif)
                <?php $sel = $v->id == $fkelas ? " selected" : ""; ?>
                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->tingkatan.$v->nama." (TA: {$ta->tahun})" }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="filter_siswa">Pilih Siswa</label>
        <select id="filter_siswa" name="filter_siswa" class="select2bs4 form-control">
            <option value="">Pilih Siswa</option>
            @foreach ($siswa as $v)
                <?php $sel = $v->id == $fsiswa ? " selected" : ""; ?>
                <?php if ($v->id == $fsiswa) $has_siswa = true; ?>
                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
@else

@if (!($user->role === "orang_tua" && isset($siswa) && count($siswa) == 1))
<div class="col-md-12">
    <div class="form-group">
        <label for="filter_siswa">Pilih Siswa</label>
        <select id="filter_siswa" name="filter_siswa" class="select2bs4 form-control">
            <option value="">Pilih Siswa</option>
            @foreach ($siswa as $v)
                <?php $sel = $v->id == $fsiswa ? " selected" : ""; ?>
                <?php if ($v->id == $fsiswa) $has_siswa = true; ?>
                <option value="{{ $v->id }}"{!! $sel !!}>{{ $v->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
@else
<?php $has_siswa = (count($siswa) > 0); ?>
@endif
@endif

@if ($has_siswa)
    <div class="col-md" style="margin-bottom: 10px;">
        <div class="card-header">
            <?php $kelas = $sel_siswa->kelas(); ?>
            <?php $wali_kelas = $kelas->wali_kelas(); ?>
            <h5 class="card-title card-text mb-2">Nama Siswa : {{ $sel_siswa->nama }}</h5>
            <h5 class="card-title card-text mb-2">Kelas : {{ $kelas->tingkatan.$kelas->nama }}</h5>
            <h5 class="card-title card-text mb-2">Wali Kelas : {{ " (NIP : {$wali_kelas->nip}) {$wali_kelas->nama}" }}</h5>
        </div>
        @if (isset($allow_edit) && $allow_edit)
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; {{ $add_title }}
                </button>
            </h3>
        </div>
        @endif
    </div>
@endif

<div class="row">
    <div class="col-md">
        <div class="form-group">
            <label for="tujuan_kelas">Tujuan Kelas</label>
            <select id="tujuan_kelas" name="tujuan_kelas" class="select2bs4 form-control @error('tujuan_kelas') is-invalid @enderror">
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

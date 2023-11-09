<div class="row">
    <div class="col-md">
        <div class="form-group">
            <h5>Tujuan Kelas</h5>
            @foreach (App\Models\Master\Kelas::get_kelas_aktif() as $k)
                <div class="form-check">
                    <?php
                        if (isset($tujuan_kelas) && in_array($k->id, $tujuan_kelas)) {
                            $checked = " checked";
                        } else {
                            $checked = "";
                        }
                    ?>
                    <input class="form-check-input" type="checkbox" name="tujuan_kelas[]" value="{{ $k->id }}" id="flexCheckDefault"{!! $checked !!}/>
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $k->tingkatan.$k->nama }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>

<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\OrangTua;

class HarianIsian extends Model
{
    use CreatedByTrait;

    protected $fillable = ['id_siswa', 'id_data', 'jawaban', 'created_by'];

    protected $table = 'monitoring_harian_isian';

    public $timestamps = true;

    public function feedback_by()
    {
        if (!$this->feedback_by)
            return NULL;

        $orang_tua = OrangTua::find($this->feedback_by);
        if (!$orang_tua)
            return NULL;

        return $orang_tua->nama;
    }
}

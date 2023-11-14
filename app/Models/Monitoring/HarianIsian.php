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

    public static function get_data_siswa_by_tanggal($id, $tanggal)
    {
        return self::join("data_harian_isian", "data_harian_isian.id", "monitoring_harian_isian.id_data")
                   ->where("monitoring_harian_isian.id_siswa", $id)
                   ->where("data_harian_isian.tgl_mulai", "<=", $tanggal)
                   ->where("data_harian_isian.tgl_selesai", ">=", $tanggal)
                   ->get();
    }

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

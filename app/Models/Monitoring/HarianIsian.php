<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\OrangTua;
use App\Models\Master\Siswa;
use App\Models\Master\HarianIsian as HarianIsianMaster;

class HarianIsian extends Model
{
    use CreatedByTrait;

    protected $fillable = ['id_siswa', 'id_data', 'jawaban', 'tanggal', 'created_by'];

    protected $table = 'monitoring_harian_isian';

    public $timestamps = true;

    public static function get_pertanyaan($id_siswa, $tanggal)
    {
        $siswa = Siswa::find($id_siswa);
        if (!$siswa)
            return NULL;

        $kelas = $siswa->kelas();
        if (!$kelas)
            return NULL;

        return HarianIsianMaster::select("data_harian_isian.*")
                    ->join("data_harian_isian_kelas", "data_harian_isian.id", "data_harian_isian_kelas.id_data")
                    ->where("data_harian_isian_kelas.id_kelas", $kelas->id)
                    ->where("data_harian_isian.tgl_mulai", "<=", $tanggal)
                    ->where("data_harian_isian.tgl_selesai", ">=", $tanggal)
                    ->get();
    }

    public static function get_jawaban($id_data, $id_siswa, $tanggal)
    {
        return self::where("id_data", $id_data)
                   ->where("id_siswa", $id_siswa)
                   ->where("tanggal", $tanggal)
                   ->first();
    }

    public static function get_pertanyaan_dan_jawaban($id_siswa, $tanggal)
    {
        $ret = [];
        $pertanyaan = self::get_pertanyaan($id_siswa, $tanggal);
        foreach ($pertanyaan as $p) {
            $jawaban = self::get_jawaban($p->id, $id_siswa, $tanggal);
            $ret[] = [
                "p" => $p,
                "j" => $jawaban
            ];
        }

        return $ret;
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

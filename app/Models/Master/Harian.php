<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Kelas;

class Harian extends Model
{
    protected $fillable = ['bulan', 'tahun', 'id_kelas'];

    protected $table = 'data_harian';

    public $timestamps = true;

    public const MAX_YEAR = 2100;    

    public const LIST_BULAN = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, "id_kelas", "id");
    }

    public function bulan()
    {
        return self::LIST_BULAN[$this->bulan - 1];
    }

    public static function get_list_tahun_by_kelas($id_kelas)
    {
        $ret = [];
        $year_now = (int)date("Y");
        for ($i = $year_now; $i <= self::MAX_YEAR; $i++) {
            $ret[] = $i;
        }

        return $ret;
    }

    public static function get_list_bulan_by_kelas_and_tahun($id_kelas, $tahun)
    {
        $list = self::where("id_kelas", $id_kelas)->where("tahun", $tahun)->get();
        $ret = [];

        for ($i = 1; $i <= 12; $i++) {
            $skip = false;
            foreach ($list as $v) {
                if ($v->bulan == $i) {
                    $skip = true;
                    break;
                }
            }

            if ($skip)
                continue;

            $ret[$i] = self::LIST_BULAN[$i - 1];
        }

        return $ret;
    }
}

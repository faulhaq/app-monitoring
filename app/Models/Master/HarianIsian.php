<?php

namespace App\Models\Master;

use DB;
use Illuminate\Database\Eloquent\Model;

class HarianIsian extends Model
{

    protected $fillable = ['status', 'pertanyaan', 'tgl_mulai', 'tgl_selesai', 'created_at'];

    protected $table = 'data_harian_isian';

    public static function apply_kelas($id_data, ?array $tujuan_kelas)
    {
        DB::table("data_harian_isian_kelas")
            ->where("id_data", $id_data)
            ->delete();

        if (!$tujuan_kelas) {
            return true;
        }
        
        $data = [];
        foreach ($tujuan_kelas as $id_kelas) {
            $data[] = [
                "id_data"  => $id_data,
                "id_kelas" => $id_kelas
            ];
        }

        return DB::table("data_harian_isian_kelas")->insert($data);
    }

    public static function get_tujuan_kelas($id_data)
    {
        $data = DB::table("data_harian_isian_kelas")
                ->where("id_data", $id_data)
                ->get();
        $ret = [];
        foreach ($data as $v) {
            $ret[] = $v->id_kelas;
        }

        return $ret;
    }

    public function get_list_kelas_view()
    {
        $kelas = "";

        $data = DB::table("kelas")
                ->select("kelas.*")
                ->join("data_harian_isian_kelas", "kelas.id", "data_harian_isian_kelas.id_kelas")
                ->where("data_harian_isian_kelas.id_data", $this->id)
                ->orderBy("kelas.tingkatan", "asc")
                ->orderBy("kelas.nama", "asc")
                ->get();

        $i = 0;
        foreach ($data as $v) {
            $kelas .= ($i == 0 ? "" : ", ").$v->tingkatan.$v->nama;
            $i++;
        }

        return $kelas;
    }
}

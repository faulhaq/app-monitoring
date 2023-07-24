<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitoringRumah extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'tipe', 'data', 'created_by', 'created_at', 'deleted_at'];

    protected $table = 'monitoring_rumah';

    public static function add_tujuan_kelas($id_monitoring, $array_id_kelas)
    {
        $created_by = Auth::user()->id ?? NULL;
        $data = [];
        foreach ($array_id_kelas as $id_kelas) {
            $data[] = [
                "id_monitoring" => $id_monitoring,
                "id_kelas" => $id_kelas,
                "created_by" => $created_by,
                "created_at" => date("Y-m-d H:i:s")
            ];
        }
        DB::table("monitoring_rumah_kelas")->where("id_monitoring", $id_monitoring)->delete();
        DB::table("monitoring_rumah_kelas")->insert($data);
    }

    public static function get_checked_kelas($id_monitoring)
    {
        $res = DB::table("monitoring_rumah_kelas")->where("id_monitoring", $id_monitoring)->get();
        $ret = [];
        foreach ($res as $v) {
            $ret[$v->id_kelas] = true;
        }
        return $ret;
    }

    public static function get_per($id_kelas, $id_siswa, $type = NULL, $tanggal = NULL)
    {
        $ret = DB::table("monitoring_rumah as a")
                ->leftJoin("monitoring_rumah_data as b", "a.id", "b.id_monitoring")
                ->join("monitoring_rumah_kelas as c", "a.id", "c.id_monitoring")
                ->where("c.id_kelas", $id_kelas)
                ->where(function ($q) use ($id_siswa, $tanggal) {
                    $q = $q->where("b.id_siswa", $id_siswa);
                    if (isset($tanggal)) {
                        $q = $q->where("b.created_at", ">=", $tanggal." 00:00:00")
                               ->where("b.created_at", "<=", $tanggal." 23:59:59");
                    }
                    $q->orWhereNull("b.id_siswa");
                });
        
        if (is_string($type)) {
            $ret = $ret->where("tipe", $type);
        }

        return $ret->get();
    }

    public static function simpan_jawaban($id_orang_tua, $id_siswa, $jawaban)
    {
        $ids = [];
        foreach ($jawaban as $id_monitoring => $v) {
            $ids[] = $id_monitoring;
        }
        DB::table("monitoring_rumah_data")
            ->where("id_siswa", $id_siswa)
            ->wherein("id_monitoring", $ids)
            ->delete();

        $data = [];
        foreach ($jawaban as $id_monitoring => $v) {
            if ($v === NULL)
                continue;
            $data[] = [
                "id_siswa" => $id_siswa,
                "id_monitoring" => $id_monitoring,
                "jawaban" => $v,
                "created_by" => $id_orang_tua,
                "created_at" => date("Y-m-d H:i:s"),
            ];
        }

        DB::table("monitoring_rumah_data")->insert($data);
        return 0;
    }
}

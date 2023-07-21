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
}

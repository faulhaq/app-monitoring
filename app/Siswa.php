<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    protected $fillable = ['no_induk', 'nis', 'nama', 'id_kelas', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto'];

    public function kelas()
    {
        return $this->belongsTo('App\Kelas')->withDefault();
    }

    public static function getByOrangTuaId($id)
    {
        return static::
                select([
                    "siswa.*"
                ])
                ->join("orang_tua_siswa", "siswa.id", "orang_tua_siswa.id_siswa")
                ->join("orang_tua", "orang_tua.id", "orang_tua_siswa.id_orang_tua")
                ->where("orang_tua.id", $id)
                ->get();
    }

    public static function hapusAnakDariOrangTua($id_siswa, $id_orang_tua)
    {
        return DB::table("orang_tua_siswa")
                ->where("id_orang_tua", $id_orang_tua)
                ->where("id_siswa", $id_siswa)
                ->limit(1)
                ->delete();
    }

    protected $table = 'siswa';
}

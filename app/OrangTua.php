<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrangTua extends Model
{
    use SoftDeletes;

    protected $fillable = ['nik', 'nama', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'agama', 'pendidikan', 'goldar', 'pekerjaan', 'alamat', 'foto'];

    protected $table = 'orang_tua';

    public static function get_list_anak($id_orang_tua)
    {
        return DB::table("orang_tua AS a")
                ->join("orang_tua_siswa AS b", "a.id", "b.id_orang_tua")
                ->join("siswa AS c", "c.id", "b.id_siswa")
                ->select("c.*")
                ->where("a.id", $id_orang_tua)
                ->get();
    }
}


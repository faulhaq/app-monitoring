<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class TahunAjaran extends Model
{
    protected $fillable = ['tahun'];

    protected $table = 'tahun_ajaran';

    private $id_aktif;

    public function __construct(...$va_args)
    {
        parent::__construct(...$va_args);
        $sel = DB::table("tahun_ajaran_aktif")->select(["id_tahun_ajaran"])->first();
        if ($sel) {
            $this->id_aktif = $sel->id_tahun_ajaran;
        }
    }

    public function status()
    {
        return $this->id == $this->id_aktif ? "Aktif" : "Non-aktif";
    }

    public static function get_id_tahun_ajaran_aktif()
    {
        $ret = DB::table("tahun_ajaran_aktif")
                ->select(["id_tahun_ajaran"])
                ->first();

        if (!$ret) {
            return NULL;
        }

        return $ret->id_tahun_ajaran;
    }
}

<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class TahunAjaran extends Model
{
    use SoftDeletes;

    protected $fillable = ['tahun', 'status'];

    protected $table = 'tahun_ajaran';

    private $id_aktif;

    public function __construct()
    {
        $sel = DB::table("tahun_ajaran_aktif")->select(["id_tahun_ajaran"])->first();
        if ($sel) {
            $this->id_aktif = $sel->id_tahun_ajaran;
        }
    }

    public function status()
    {
        return $this->id == $this->id_aktif ? "Aktif" : "Non-aktif";
    }
}

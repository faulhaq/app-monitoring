<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\OrangTua;

class Doa extends Model
{
    use CreatedByTrait;

    protected $fillable = ['id_siswa', 'doa', 'lu', 'feedback', 'feedback_by', 'created_by'];

    protected $table = 'monitoring_doa';

    public $timestamps = false;

    public static function store($arg)
    {
        if (is_array($arg)) {
            $arg["created_at"] = date("Y-m-d H:i:s");
        }

        return static::insert($arg);
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

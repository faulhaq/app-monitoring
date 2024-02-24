<?php

namespace App\Models\Monitoring;

use App\Models\Ref\Surah;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\OrangTua;

class Tahfidz extends Model
{
    use CreatedByTrait;
    
    protected $fillable = ['id_siswa', 'id_surah', 'ayat', 'lu', "catatan", 'feedback', 'feedback_by', 'created_by'];

    protected $table = 'monitoring_tahfidz';

    public $timestamps = false;

    public static function store($arg)
    {
        if (is_array($arg)) {
            $arg["created_at"] = date("Y-m-d H:i:s");
        }

        return static::insert($arg);
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class, "id_surah")->first()->nama ?? NULL;
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

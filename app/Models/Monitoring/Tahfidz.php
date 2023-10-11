<?php

namespace App\Models\Monitoring;

use App\Models\Ref\Surah;
use Illuminate\Database\Eloquent\Model;

class Tahfidz extends Model
{
    use CreatedByTrait;
    
    protected $fillable = ['id_siswa', 'id_surah', 'ayat', 'lu', 'created_by'];

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
}

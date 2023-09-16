<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;

class Hadits extends Model
{
    protected $fillable = ['id_siswa', 'hadits', 'lu', 'lokasi', 'created_by'];

    protected $table = 'monitoring_hadits';

    public $timestamps = false;

    public static function store($arg)
    {
        if (is_array($arg)) {
            $arg["created_at"] = date("Y-m-d H:i:s");
        }

        return static::insert($arg);
    }
}

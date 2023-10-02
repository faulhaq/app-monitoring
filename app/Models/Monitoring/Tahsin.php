<?php

namespace App\Models\Monitoring;

use DB;
use Illuminate\Database\Eloquent\Model;

class Tahsin extends Model
{
    use CreatedByTrait;

    protected $fillable = ['id_siswa', 'n', 'tipe', 'halaman', 'lu', 'lokasi', 'created_by'];

    protected $table = 'monitoring_tahsin';

    public $timestamps = false;

    public static function store($arg)
    {
        if (is_array($arg)) {
            $arg["created_at"] = date("Y-m-d H:i:s");
        }

        return static::insert($arg);
    }
}

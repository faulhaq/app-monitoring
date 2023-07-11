<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitoringRumah extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'tipe', 'data', 'created_by', 'created_at', 'deleted_at'];

    protected $table = 'monitoring_rumah';
}

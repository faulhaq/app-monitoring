<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;

class KunciMonitoringHarian extends Model
{
    protected $fillable = ['id_data_harian', 'id_siswa', 'tanggal'];

    protected $table = 'kunci_monitoring_harian';

    public $timestamps = false;
}

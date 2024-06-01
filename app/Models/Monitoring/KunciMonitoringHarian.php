<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Siswa;

class KunciMonitoringHarian extends Model
{
    protected $fillable = ['id_data_harian', 'id_siswa', 'tanggal', 'point', 'point_seen'];

    protected $table = 'kunci_monitoring_harian';

    public $timestamps = false;
}

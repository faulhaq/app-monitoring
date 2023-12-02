<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;

class Harian extends Model
{
    use CreatedByTrait;
    
    protected $fillable = ['id_siswa', 'id_pertanyaan', 'jawaban', 'tanggal', 'created_by'];

    protected $table = 'monitoring_harian';

    public $timestamps = true;
}

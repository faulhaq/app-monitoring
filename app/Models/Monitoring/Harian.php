<?php

namespace App\Models\Monitoring;

use App\Models\Master\Siswa;
use Illuminate\Database\Eloquent\Model;

class Harian extends Model
{
    use CreatedByTrait;
    
    protected $fillable = ['id_siswa', 'id_pertanyaan', 'jawaban', 'tanggal', 'created_by'];

    protected $table = 'monitoring_harian';

    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, "id_siswa", "id");
    }
}

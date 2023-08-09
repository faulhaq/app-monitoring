<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    public $fillable = ['id_siswa', 'id_kelas'];
    public $table = "kelas_siswa";
}

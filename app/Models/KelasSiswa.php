<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    protected $fillable = ['id_siswa', 'id_kelas'];

    protected $table = 'kelas_siswa';
}

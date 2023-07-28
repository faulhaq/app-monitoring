<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ref\Agama;
use App\Models\Ref\Pendidikan;

class Siswa extends Model
{
    use SoftDeletes;

    protected $fillable = ['nik', 'nis', 'nama', 'jk', 'agama', 'goldar', 'pendidikan', 'telp', 'tmp_lahir', 'tgl_lahir', 'alamat', 'foto'];

    protected $table = "siswa";

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, "kelas_siswa", "id_siswa", "id_kelas")
                    ->join("tahun_ajaran", "tahun_ajaran.id", "kelas.id_tahun_ajaran")
                    ->where("tahun_ajaran.status", "=", "aktif");
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, "agama")->first()->nama ?? NULL;
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, "pendidikan")->first()->nama ?? NULL;
    }
}

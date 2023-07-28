<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $fillable = ['tingkatan', 'nama', 'id_tahun_ajaran', 'id_guru'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, "id_guru")->first();
    }

    public function wali_kelas()
    {
        return $this->guru();
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, "id_tahun_ajaran")->first();
    }

    public static function get_kelas_aktif()
    {
        return self::select("kelas.*")
                ->join("tahun_ajaran", "tahun_ajaran.id", "=", "kelas.id_tahun_ajaran")
                ->join("tahun_ajaran_aktif", "tahun_ajaran.id", "=", "tahun_ajaran_aktif.id_tahun_ajaran")
                ->get();
    }

    protected $table = 'kelas';
}

<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ref\Agama;
use App\Models\Ref\Goldar;
use App\Models\Ref\Pendidikan;
use App\Models\KelasSiswa;
use DB;

class Siswa extends Model
{
    use SoftDeletes;

    protected $fillable = ['nik', 'nis', 'nama', 'jk', 'agama', 'goldar', 'pendidikan', 'telp', 'tmp_lahir', 'tgl_lahir', 'alamat', 'foto', 'status', 'id_kelas_aktif'];

    protected $table = "siswa";

    public function kelas()
    {
        $ret = $this->belongsTo(Kelas::class, "id_kelas_aktif")->first();
        return is_null($ret) ? (object) ["id" => 0, "tingkatan" => NULL, "nama" => NULL] : $ret;
    }

    public function goldar()
    {
        return $this->belongsTo(Goldar::class, "goldar")->first()->nama ?? NULL;
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, "agama")->first()->nama ?? NULL;
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, "pendidikan")->first()->nama ?? NULL;
    }

    public function status()
    {
        return ucwords($this->status);
    }

    public static function get_siswa_by_id_kelas($id_kelas)
    {
        return self::select(["siswa.*", "kelas_siswa.id_kelas", "kelas_siswa.id as id_kelas_siswa"])
                ->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                ->where("kelas_siswa.id_kelas", $id_kelas);
    }
}

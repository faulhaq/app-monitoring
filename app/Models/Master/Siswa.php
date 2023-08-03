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

    public static function create_and_add_kelas($data)
    {
        $siswa = self::create($data + ["id_kelas_aktif" => $data["id_kelas"]]);
        KelasSiswa::create([
            "id_siswa" => $siswa->id,
            "id_kelas" => $data["id_kelas"]
        ]);
        return $siswa;
    }

    public function update_data_dan_kelas($data)
    {
        $old_id_kelas = $this->id_kelas_aktif;
        $this->update($data + ["id_kelas_aktif" => $data["id_kelas"]]);
        $x = KelasSiswa::where("id_kelas", $old_id_kelas)
            ->where("id_siswa", $this->id)
            ->update(["id_kelas" => $data["id_kelas"]]);
    }

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
}

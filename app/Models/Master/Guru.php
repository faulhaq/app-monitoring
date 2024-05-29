<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ref\TraitRef;

class Guru extends Model
{
    use SoftDeletes;
    use TraitRef;

    protected $fillable = ['nik', 'nsm', 'nama', 'email', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'agama', 'pendidikan', 'goldar', 'pekerjaan', 'alamat', 'foto', 'status'];

    protected $table = 'guru';

    public function data_siswa($id)
    {
        $kelas = Kelas::where("id_guru", $id)->first();
        if (!$kelas) {
            return null;
        }

        $siswa_kelas = KelasSiswa::where("id_kelas", $kelas->id)->get();
        if (!$siswa_kelas) {
            return null;
        }

        $data_siswa = [];
        foreach ($siswa_kelas as $s) {
            $data_siswa[] = Siswa::where("id", $s->id_siswa)->first();
        }
        
        return $data_siswa;
    }
}

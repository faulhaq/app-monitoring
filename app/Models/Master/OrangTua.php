<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Ref\TraitRef;

class OrangTua extends Model
{
    use TraitRef;

    protected $fillable = ['id_kk', 'nik', 'nama', 'email', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'agama', 'pendidikan', 'goldar', 'pekerjaan', 'alamat', 'foto'];

    protected $table = 'orang_tua';

    public function kk()
    {
       return $this->belongsTo(KK::class, "id_kk")->first();
    }

    public function get_all_anak()
    {
        return Siswa::where("id_kk", $this->id_kk)->get();
    }

    /**
     * Return true jika anaknya.
     * Return false jika bukan anaknya.
     */
    public function validate_anak($id_siswa)
    {
        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            return false;
        }

        return $siswa->id_kk === $this->id_kk;
    }
}

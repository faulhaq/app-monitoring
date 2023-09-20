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
}

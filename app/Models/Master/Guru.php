<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ref\TraitRef;

class Guru extends Model
{
    use SoftDeletes;
    use TraitRef;

    protected $fillable = ['nik', 'nip', 'nama', 'email', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'agama', 'pendidikan', 'goldar', 'pekerjaan', 'alamat', 'foto', 'status'];

    protected $table = 'guru';
}

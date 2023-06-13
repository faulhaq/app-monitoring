<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrangTua extends Model
{
    use SoftDeletes;

    protected $fillable = ['nik', 'nama', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'agama', 'pendidikan', 'goldar', 'pekerjaan', 'alamat', 'foto'];

    protected $table = 'orang_tua';
}

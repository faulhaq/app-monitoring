<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $fillable = ['nama_kelas', 'id_guru'];

    public function guru()
    {
        return $this->belongsTo('App\Guru', 'id')->withDefault();
    }

    protected $table = 'kelas';
}

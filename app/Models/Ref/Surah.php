<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    protected $fillable = ['nama', 'jumlah_ayat'];

    protected $table = 'surah';

    public $timestamps = false;
}

<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $fillable = ['nama'];

    protected $table = 'pendidikan';

    public $timestamps = false;
}

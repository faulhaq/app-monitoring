<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;

class Doa extends Model
{
    protected $fillable = ['nama'];

    protected $table = 'doa';

    public $timestamps = false;
}

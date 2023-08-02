<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $fillable = ['nama'];

    protected $table = 'agama';

    public $timestamps = false;
}

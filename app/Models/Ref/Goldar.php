<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;

class Goldar extends Model
{
    protected $fillable = ['nama'];

    protected $table = 'goldar';

    public $timestamps = false;
}

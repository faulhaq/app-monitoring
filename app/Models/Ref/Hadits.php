<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;

class Hadits extends Model
{
    protected $fillable = ['nama'];

    protected $table = 'hadits';

    public $timestamps = false;
}

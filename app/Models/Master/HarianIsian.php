<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class HarianIsian extends Model
{

    protected $fillable = ['pertanyaan', 'created_at'];

    protected $table = 'data_harian_isian';
}

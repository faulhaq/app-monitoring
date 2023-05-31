<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Account
{
    use HasFactory;


    protected $table = 'orang_tua';
    protected $primaryKey = 'id';
    public $incrementing = true;
}

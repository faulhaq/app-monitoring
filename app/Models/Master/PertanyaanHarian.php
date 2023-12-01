<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class PertanyaanHarian extends Model
{
    use CreatedByTrait;

    protected $fillable = ['id_data_harian', 'pertanyaan', 'tipe', 'list_opsi'];

    protected $table = 'pertanyaan_data_harian';

    public $timestamps = true;
}

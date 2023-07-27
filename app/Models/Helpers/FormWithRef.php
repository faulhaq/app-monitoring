<?php

namespace App\Models\Helpers;

use App\Models\Ref\Agama;
use App\Models\Ref\Pendidikan;
use App\Models\Ref\Pekerjaan;
use App\Models\Ref\Goldar;

class FormWithRef
{
    public static function get_agama()
    {
        return Agama::get();
    }

    public static function get_pendidikan()
    {
        return Pendidikan::get();
    }

    public static function get_pekerjaan()
    {
        return Pekerjaan::get();
    }

    public static function get_goldar()
    {
        return Goldar::get();
    }
}

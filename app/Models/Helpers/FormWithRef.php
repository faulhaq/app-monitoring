<?php

namespace App\Models\Helpers;

use App\Models\Ref\Agama;
use App\Models\Ref\Pendidikan;
use App\Models\Ref\Pekerjaan;
use App\Models\Ref\Goldar;
use App\Models\Ref\Mahfudhot;

class FormWithRef
{
    private static function gen_drop_down($data, $selected_val = null)
    {
        $ret = "";
        foreach ($data as $v) {
            $sel = (!is_null($selected_val) && $v->id == $selected_val) ? " selected" : "";
            $ret .= "<option value=\"".e($v->id)."\"{$sel}>".e($v->nama)."</option>";
        }
        return $ret;
    }

    public static function get_agama($selval = null)
    {
        return self::gen_drop_down(Agama::get(), $selval);
    }

    public static function get_pendidikan($selval = null)
    {
        return self::gen_drop_down(Pendidikan::get(), $selval);
    }

    public static function get_pekerjaan($selval = null)
    {
        return self::gen_drop_down(Pekerjaan::get(), $selval);
    }

    public static function get_goldar($selval = null)
    {
        return self::gen_drop_down(Goldar::get(), $selval);
    }

    // public static function get_mahfudhot($selval = null)
    // {
    //     return self::gen_drop_down(Mahfudhot::get(), $selval);
    // }
}

<?php

namespace App\Models\Monitoring;

use DB;

trait CreatedByTrait
{
    public function created_by()
    {
        if ($this->created_by === NULL)
            return "Admin";

        $ret = DB::table("users");

        if ($this->lokasi === "sekolah") {
            $ret = $ret->join("guru", "guru.id", "users.id_guru");
        } else if ($this->lokasi === "rumah") {
            $ret = $ret->join("orang_tua", "orang_tua.id", "users.id_orang_tua");
        } else {
            return "unknown";
        }

        return $ret->first()->nama ?? "unknown";
    }
}

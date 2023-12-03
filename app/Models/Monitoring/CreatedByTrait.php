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

        $ret = $ret->join("guru", "guru.id", "users.id_guru");
        

        return $ret->first()->nama ?? "unknown";
    }
}

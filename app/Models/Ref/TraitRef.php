<?php

namespace App\Models\Ref;

trait TraitRef {
    
    public function goldar()
    {
        return $this->belongsTo(Goldar::class, "goldar")->first()->nama ?? NULL;
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, "pendidikan")->first()->nama ?? NULL;
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, "agama")->first()->nama ?? NULL;
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, "pekerjaan")->first()->nama ?? NULL;
    }
}

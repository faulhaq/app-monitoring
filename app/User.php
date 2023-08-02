<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Master\OrangTua;
use App\Models\Master\Guru;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role', 'id_guru', 'id_orang_tua'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function nama()
    {
        if ($this->role === "admin") {
            return "Admin";
        } else if ($this->role === "orang_tua") {
            return $this->belongsTo(OrangTua::class, "id_orang_tua")->first()->nama;
        } else if ($this->role === "guru") {
            return $this->belongsTo(Guru::class, "id_guru")->first()->nama;
        }

        return "";
    }
}

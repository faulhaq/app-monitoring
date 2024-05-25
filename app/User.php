<?php

namespace App;

use DB;
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

    public function guru()
    {
        return Guru::find($this->id_guru);
    }

    public function orang_tua()
    {
        return OrangTua::find($this->id_orang_tua);
    }

    public function isWaliKelas()
    {
        if ($this->role !== "guru") {
            return false;
        }

        $ret = DB::table("users")
                ->join("guru", "guru.id", "users.id_guru")
                ->join("kelas", "guru.id", "kelas.id_guru")
                ->where("users.id", $this->id)
                ->first();
        return (bool)$ret;
    }

    public function role()
    {
        if ($this->role === "admin") {
            return "Admin";
        } else if ($this->role === "orang_tua") {
            return "Orang Tua";
        } else if ($this->role === "guru") {
            return "Guru";
        }
    }

    public function name()
    {
        if ($this->role === "admin") {
            return "Admin {$this->id}";
        } else if ($this->role === "orang_tua") {
            $ret = DB::table("orang_tua")->where("id", $this->id_orang_tua);
        } else if ($this->role === "guru") {
            $ret = DB::table("guru")->where("id", $this->id_guru);
        }

        $ret = $ret->limit(1)->first();
        return $ret->nama ?? "";
    }
    public function profile()
    {
        if ($this->role === "guru") {
            $ret = DB::table("guru")->where("id", $this->id_guru)->first();
            $ret->foto =(!empty($ret->foto)) ? "uploads/".$this->role."/".$ret->foto  : "img/placeholder.jpg";
            return $ret;
        } else if ($this->role === "orang_tua") {
            $ret = DB::table("orang_tua")->where("id", $this->id_orang_tua)->first();
            $ret->foto =(!empty($ret->foto)) ? "uploads/".$this->role."/".$ret->foto  : "img/placeholder.jpg";
            return $ret;
        } else if ($this->role === "siswa") {
            $ret = DB::table("siswa")->where("id", $this->id_siswa)->first();
            $ret->foto =(!empty($ret->foto)) ? "uploads/".$this->role."/".$ret->foto  : "img/placeholder.jpg";
            return $ret;
        } else {
            return null;
        }
    }
}

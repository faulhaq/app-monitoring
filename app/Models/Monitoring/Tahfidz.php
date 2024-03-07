<?php

namespace App\Models\Monitoring;

use App\Models\Master\Guru;
use App\Models\Master\OrangTua;
use App\Models\Ref\Surah;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Tahfidz extends Model
{
    use CreatedByTrait;

    protected $fillable = ['id_siswa', 'id_surah', 'ayat', 'lu', "catatan", 'feedback', 'feedback_by', 'created_by'];

    protected $table = 'monitoring_tahfidz';

    public $timestamps = false;

    public static function store($arg)
    {
        if (is_array($arg)) {
            $arg["created_at"] = date("Y-m-d H:i:s");
        }

        return static::insert($arg);
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class, "id_surah")->first()->nama ?? null;
    }

    public function feedback_by()
    {
        if (!$this->feedback_by) {
            return null;
        }

        $orang_tua = OrangTua::find($this->feedback_by);
        if (!$orang_tua) {
            return null;
        }

        return $orang_tua->nama;
    }

    public function created_by()
    {
        if (!$this->created_by) {
            return null;
        }

        $user = User::find($this->created_by);
        if (!$user) {
            return null;
        }

        $guru = Guru::find($user->id_guru);
        if (!$guru) {
            return null;
        }

        return $guru->nama;
    }
}

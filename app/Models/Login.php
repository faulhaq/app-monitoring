<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Login extends Model
{
    use HasFactory;

    public function login(string $email, string $password)
    {
        $guru = Guru::where("email", $email)->first();
        if ($guru) {
            if (password_verify($password, $guru->password)) {
                return $guru;
            } else {
                return NULL;
            }
        }

        return NULL;
    }
}

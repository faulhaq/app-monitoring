<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Guru;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function login(Request $r)
    {
        $login = new Login();
        $account = $login->login($r->email, $r->password);
        if (!$account) {
            session()->flash('alert', 'Email atau password salah');
            return redirect('login');
        }

        if ($account instanceof Guru) {
            return $this->handleLoginGuru($account);
        }
    }

    public function handleLoginGuru(Guru $guru)
    {
        switch ($guru->role) {
            case "admin":
                session([
                    "role"    => "admin",
                    "user_id" => $guru->id
                ]);
                return redirect(route("admin.dashboard"));
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Guru;
use App\Models\OrangTua;

class LoginController extends Controller
{
    //
    public function index()
    {
        $sess = session();
        $user_id = $sess->get("user_id");
        $role = $sess->get("role");

        if ($role && $user_id) {
            switch ($role) {
                case "guru":
                    return redirect(route("guru.dashboard"));
                
                case "admin":
                    return redirect(route("admin.dashboard"));
            
                case "wali_kelas":
                    return redirect(route("wali_kelas.dashboard"));

                case "orang_tua":
                    return redirect(route("orang_tua.dashboard"));
            }
        }

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

        if ($account instanceof OrangTua) {
            return $this->handleLoginOrangTua($account);
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

            case "guru":
                session([
                    "role"    => "guru",
                    "user_id" => $guru->id
                ]);
                return redirect(route("guru.dashboard"));
            
            case "wali_kelas":
                session([
                    "role"    => "wali_kelas",
                    "user_id" => $guru->id
                ]);
                return redirect(route("wali_kelas.dashboard"));
        }
    }

    public function handleLoginOrangTua(OrangTua $orang_tua)
    {
        session([
            "role"    => "orang_tua",
            "user_id" => $orang_tua->id
        ]);
        return redirect(route("orang_tua.dashboard"));
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use App\Guru;
use App\Models\Master\Kelas;
use App\Models\Master\Siswa;
// use App\Siswa;
use App\User;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Master\OrangTua;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pengumuman = Pengumuman::first();
        return view("home", compact("pengumuman"));
    }

    public function admin()
    {
    }
}

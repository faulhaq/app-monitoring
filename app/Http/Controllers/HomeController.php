<?php

namespace App\Http\Controllers;

use Auth;
use DB;
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
        $guru_lk = DB::select("SELECT COUNT(1) AS c FROM `guru` WHERE jk = 'L' GROUP BY jk;")[0]->c ?? 0;
        $guru_pr = DB::select("SELECT COUNT(1) AS c FROM `guru` WHERE jk = 'P' GROUP BY jk;")[0]->c ?? 0;
        $guru_all = DB::select("SELECT COUNT(1) AS c FROM `guru`;")[0]->c ?? 0;

        $siswa_lk = DB::select("SELECT COUNT(1) AS c FROM `siswa` WHERE jk = 'L' GROUP BY jk;")[0]->c ?? 0;
        $siswa_pr = DB::select("SELECT COUNT(1) AS c FROM `siswa` WHERE jk = 'P' GROUP BY jk;")[0]->c ?? 0;
        $siswa_all = DB::select("SELECT COUNT(1) AS c FROM `siswa`;")[0]->c ?? 0;

        $profil = Auth::user()->profile();


        return view("home", compact("pengumuman", "guru_lk", "guru_pr", "guru_all",
                                    "siswa_lk", "siswa_pr", "siswa_all", "profil"));
    }

    public function admin()
    {
    }
}

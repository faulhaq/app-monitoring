<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Kelas;
use App\Siswa;
use App\User;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('home', compact('pengumuman'));
    }

    public function admin()
    {
        $guru = Guru::count();
        $gurulk = Guru::where('jk', 'L')->count();
        $gurupr = Guru::where('jk', 'P')->count();
        $siswa = Siswa::count();
        $siswalk = Siswa::where('jk', 'L')->count();
        $siswapr = Siswa::where('jk', 'P')->count();
        $kelas = Kelas::count();
        $user = User::count();
        return view('admin.index', compact(
            'guru',
            'gurulk',
            'gurupr',
            'siswalk',
            'siswapr',
            'siswa',
            'kelas',
            'user'
        ));
    }
}

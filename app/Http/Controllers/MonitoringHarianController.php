<?php

namespace App\Http\Controllers;

use URL;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Master\Siswa;
use App\Models\Master\Kelas;
use App\Models\Master\TahunAjaran;

class MonitoringHarianController extends Controller
{
    public function index()
    {
        return view("monitoring.harian.index");
    }

    public function get_created_by()
    {
        $user = Auth::user();
        if ($user->role === "admin")
            return NULL;

        if ($user->role === "orang_tua")
            return $user->id;

        abort(404);
        return NULL;
    }

    private function get_kelas($user)
    {
        if ($user->role !== "orang_tua")
            return Kelas::get();

        return NULL;
    }

    /*
     * Pengisian variable $siswa terdapat 2 kondisi:
     * 1. Ketika $user->role !== "orang_tua":
     *    Tampilkan semua siswa (hanya ketika $fkelas !== "all").
     * 
     * 2. Ketika $user->role === "orang_tua":
     *    Tampilkan semua siswa yang memiliki id_kk sama dengan
     *    orang tua.
     */
    private function get_siswa($fkelas, $user)
    {
        if (($fkelas && $fkelas !== "all") || $user->role === "orang_tua") {
            $siswa = Siswa::select("siswa.*");

            if ($user->role !== "orang_tua") {
                $siswa = $siswa
                        ->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                        ->where("kelas_siswa.id_kelas", $fkelas);
            }

            if ($user->role === "orang_tua") {
                $siswa = $siswa
                            ->join("kk", "kk.id", "siswa.id_kk")
                            ->join("orang_tua", "kk.id", "orang_tua.id_kk")
                            ->join("users", "orang_tua.id", "users.id_orang_tua")
                            ->where("users.id", $user->id);
            }

            $siswa = $siswa->get();
        } else {
            $siswa = [];
        }
        return $siswa;
    }


}




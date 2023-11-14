<?php

namespace App\Http\Controllers;

use URL;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Master\Siswa;
use App\Models\Master\Kelas;
use App\Models\Master\TahunAjaran;
use App\Models\Monitoring\HarianIsian;

class MonitoringHarianController extends Controller
{
    public function index()
    {
        return view("monitoring.harian.index");
    }

    public function simpan_jawaban(Request $r)
    {
        foreach ($_POST as $k => $v) {
            if (substr($k, 0, 8) !== "jawaban_")
                continue;
            if (!is_string($k))
                continue;
            $id = substr($k, 8);
            if (!is_numeric($id))
                continue;
            var_dump($id, $v);
        }
    }

    private function form_isi_orang_tua($user)
    {
        $ftanggal = isset($_GET["ftanggal"]) ? date("Y-m-d", strtotime($_GET["ftanggal"])) : date("Y-m-d");
        $orang_tua = $user->orang_tua();
        if (!$orang_tua) {
            abort(404);
            return;
        }

        $siswa = $orang_tua->get_all_anak();
        if (count($siswa) === 1) {
            $harian = HarianIsian::get_data_siswa_by_tanggal($siswa[0]->id, $ftanggal);
        } else {
            $harian = [];
        }

        return view("monitoring.harian.harian_orang_tua", compact("siswa", "harian", "ftanggal"));
    }

    public function form_isi()
    {
        $user = Auth::user();
        if ($user->role === "orang_tua") {
            return $this->form_isi_orang_tua($user);
        }
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




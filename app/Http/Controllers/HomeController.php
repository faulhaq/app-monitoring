<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Guru;
use App\Models\Master\Harian;
use App\Models\Monitoring\Harian as MonitoringHarian;
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

        $bulan = (int) date("m");
        $tahun = (int) date("Y");

        if (Auth::user()->role === "orang_tua") {
            $siswa = (new OrangTua())->data_anak(Auth::user()->id_orang_tua);

            $data_harian = [];
            foreach ($siswa as $s) {
                $harian = Harian::where("bulan", $bulan)
                ->where("tahun", $tahun)
                ->where("id_kelas", $s->kelas()->id)
                    ->first()->toArray();

                $data_harian[] = $harian;
            }

            $id_siswa = array_column($siswa->toArray(), "id");

            if ($data_harian) {
                $data_jawaban = [];
                foreach ($id_siswa as $id) {
                    $jawaban = MonitoringHarian::with("siswa")->where("tanggal", "LIKE", "{$tahun}-" . sprintf("%02d", $bulan) . "-%")
                        ->where("id_siswa", $id)
                        ->get();
                    $data_jawaban[] = $jawaban;
                }
            }

            $data_list_tanggal = [];
            foreach ($data_jawaban as $dj) {
                $list_tanggal = [];
                for ($i = 1; $i <= 31; $i++) {
                    $dt = "{$tahun}-" . sprintf("%02d", $bulan) . "-" . sprintf("%02d", $i);
                    $ep = strtotime($dt);
                    if (date("Y-m-d", $ep) !== $dt)
                        continue;

                    $data_siswa = [];
                    $found = false;
                    foreach ($dj as $j) {
                        if ($j->tanggal !== $dt) {
                            $found = false;
                            $data_siswa = $j->siswa;
                            break;
                        }
                    }
                    foreach ($dj as $j) {
                        if ($j->tanggal === $dt) {
                            $found = true;
                            break;
                        }
                    }

                    $list_tanggal[$dt] = ["status" => $found, "siswa" => $data_siswa];
                }
                $data_list_tanggal[] = $list_tanggal;
            }

            $data_notif =  array_map(
                function ($array) {
                    return array_filter($array, function ($value) {
                        return $value["status"] === false;
                    });
                },
                $data_list_tanggal
            );
        }  else {
            $data_notif = [];
        }
        
        return view("home", compact("pengumuman", "guru_lk", "guru_pr", "guru_all",
                                    "siswa_lk", "siswa_pr", "siswa_all", "profil", "data_notif"));
    }

    public function admin()
    {
    }
}

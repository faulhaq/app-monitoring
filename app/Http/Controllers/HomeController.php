<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\Master\Guru;
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
use App\Models\Monitoring\Doa;
use App\Models\Monitoring\Hadits;
use App\Models\Monitoring\Mahfudhot;
use App\Models\Monitoring\Tahfidz;
use App\Models\Monitoring\Tahsin;

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
                    ->first();

                $data_harian[] = $harian;
            }

            $id_siswa = array_column($siswa, "id");

            $data_jawaban = [];
            $data_monitoring_agama = [];
            foreach ($id_siswa as $id) {
                $jawaban = MonitoringHarian::with("siswa")->where("tanggal", "LIKE", "{$tahun}-" . sprintf("%02d", $bulan) . "-%")
                    ->where("id_siswa", $id)
                    ->get()->toArray();

                $tahfidz = Tahfidz::with("siswa")->where("id_siswa", $id)->orderBy("tanggal", "desc")->first();
                $tahsin = Tahsin::with("siswa")->where("id_siswa", $id)->orderBy("tanggal", "desc")->first();
                $mahfudhot = Mahfudhot::with("siswa")->where("id_siswa", $id)->orderBy("tanggal", "desc")->first();
                $hadits = Hadits::with("siswa")->where("id_siswa", $id)->orderBy("tanggal", "desc")->first();
                $doa = Doa::with("siswa")->where("id_siswa", $id)->orderBy("tanggal", "desc")->first();

                $data_monitoring_agama[] = compact("tahfidz", "tahsin", "mahfudhot", "hadits", "doa");

                $data_jawaban[] = $jawaban;
            }

            $data_monitoring_agama = array_map(function($array) {
                return array_filter($array, function($value) {
                    return !empty($value);
                });
            }, $data_monitoring_agama);

            $data_monitoring_agama = array_values(array_filter($data_monitoring_agama, function($subarray) {
                return !empty($subarray);
            }));

            $data_jawaban = array_values(array_filter($data_jawaban, function ($subarray) {
                return !empty($subarray);
            }));

            if (!$data_jawaban && !$data_monitoring_agama) {
                $data_notif = [];
                goto out;
            }

            $data_list_tanggal = [];
            foreach ($data_jawaban as $dj) {
                $list_tanggal = [];
                for ($i = 1; $i <= date("d"); $i++) {
                    $dt = "{$tahun}-" . sprintf("%02d", $bulan) . "-" . sprintf("%02d", $i);
                    $ep = strtotime($dt);
                    if (date("Y-m-d", $ep) !== $dt)
                        continue;

                    $data_siswa = [];
                    $found = false;
                    foreach ($dj as $j) {
                        if ($j['tanggal'] !== $dt) {
                            $found = false;
                            $data_siswa = $j['siswa'];
                        }
                    }
                    foreach ($dj as $j) {
                        if ($j['tanggal'] === $dt) {
                            $found = true;
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
        } else if (Auth::user()->role === "guru") {
            $siswa = (new Guru())->data_siswa(Auth::user()->id_guru);

            $id_siswa = array_column($siswa, "id");

            $data_monitoring_agama = [];
            $data_jawaban = [];
            foreach ($id_siswa as $id) {
                $jawaban = MonitoringHarian::with("siswa")->where("tanggal", "LIKE", "{$tahun}-" . sprintf("%02d", $bulan) . "-%")
                    ->where("id_siswa", $id)
                    ->first();
                $data_jawaban[] = $jawaban;
            }


            $data_jawaban = array_values(array_filter($data_jawaban, function($subarray) {
                return !empty($subarray);
            }));

            if (!$data_jawaban) {
                $data_notif = [];
                goto out;
            }

            $data_list_tanggal = [];
            foreach ($data_jawaban as $dj) {
                $list_tanggal = [];
                for ($i = 1; $i <= date("d"); $i++) {
                    $dt = "{$tahun}-" . sprintf("%02d", $bulan) . "-" . sprintf("%02d", $i);
                    $ep = strtotime($dt);
                    if (date("Y-m-d", $ep) !== $dt)
                        continue;

                    $data_siswa = [];
                    $found = false;
                    if ($dj->tanggal !== $dt) {
                        $found = false;
                    }
                    if ($dj->tanggal === $dt) {
                        $found = true;
                        $data_siswa = $dj->siswa;
                    }

                    $list_tanggal[$dt] = ["status" => $found, "siswa" => $data_siswa];
                }
                $data_list_tanggal[] = $list_tanggal;
            }

            $data_notif = array_map(function($array) {
                return array_filter($array, function($value) {
                    return $value["status"] === true;
                });
            }, $data_list_tanggal);

        } else {
            $data_notif = [];
            $data_monitoring_agama = [];
        }
        out:
        return view("home", compact("pengumuman", "guru_lk", "guru_pr", "guru_all",
                                    "siswa_lk", "siswa_pr", "siswa_all", "profil", "data_notif", "data_monitoring_agama"));
    }

    public function admin()
    {
    }
}

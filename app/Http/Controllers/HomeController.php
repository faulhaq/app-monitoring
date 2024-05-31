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
use App\Models\Ref\Surah;
use App\Models\Ref\Doa as DoaRef;
use App\Models\Ref\Hadits as HaditsRef;
use App\Models\Ref\Mahfudhot as MahfudhotRef;
use Crypt;

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

    private function get_pencapaian(int $id_siswa)
    {
        $pdo = DB::connection()->getPdo();
        $st = $pdo->prepare("
            SELECT * FROM (
                SELECT id, created_at, 'doa' AS type FROM monitoring_doa WHERE id_siswa = {$id_siswa} AND seen_by_ortu = '0' UNION ALL
                SELECT id, created_at, 'hadits' AS type FROM monitoring_hadits WHERE id_siswa = {$id_siswa} AND seen_by_ortu = '0' UNION ALL
                SELECT id, created_at, 'mahfudhot' AS type FROM monitoring_mahfudhot WHERE id_siswa = {$id_siswa} AND seen_by_ortu = '0' UNION ALL
                SELECT id, created_at, 'tahfidz' AS type FROM monitoring_tahfidz WHERE id_siswa = {$id_siswa} AND seen_by_ortu = '0' UNION ALL
                SELECT id, created_at, 'tahsin' AS type FROM monitoring_tahsin WHERE id_siswa = {$id_siswa} AND seen_by_ortu = '0'
            ) AS all_monitoring ORDER BY created_at DESC LIMIT 5;
        ");
        $st->execute();

        $ret = [];
        foreach ($st->fetchAll() as $row) {
            if ($row['type'] === 'doa') {
                $tmp = Doa::with("siswa")->where("id_siswa", $id_siswa)->first();
                $doa = DoaRef::find($tmp->id_doa);
                $str = "{$tmp->siswa->nama} monitoring doa {$doa->nama} {$tmp->lu}";
            } elseif ($row['type'] === 'hadits') {
                $tmp = Hadits::with("siswa")->where("id_siswa", $id_siswa)->first();
                $hadits = HaditsRef::find($tmp->id_hadits);
                $str = "{$tmp->siswa->nama} monitoring hadits {$hadits->nama} {$tmp->lu}";
            } elseif ($row['type'] === 'mahfudhot') {
                $tmp = Mahfudhot::with("siswa")->where("id_siswa", $id_siswa)->first();
                $mahfudhot = MahfudhotRef::find($tmp->id_mahfudhot);
                $str = "{$tmp->siswa->nama} monitoring mahfudhot {$mahfudhot->nama} {$tmp->lu}";
            } elseif ($row['type'] === 'tahfidz') {
                $tmp = Tahfidz::with("siswa")->where("id_siswa", $id_siswa)->first();
                $surah = Surah::find($tmp->id_surah);
                $str = "{$tmp->siswa->nama} monitoring tahfidz surah {$surah->nama} ayat {$tmp->ayat} {$tmp->lu}";
            } elseif ($row['type'] === 'tahsin') {
                $tmp = Tahsin::with("siswa")->where("id_siswa", $id_siswa)->first();
                $str = "{$tmp->siswa->nama} monitoring tahsin {$tmp->tipe} {$tmp->n} halaman {$tmp->halaman} {$tmp->lu}";
            } else {
                continue;
            }

            $ret[] = [
                "id_siswa" => $tmp->siswa->id,
                "id" => $row["id"],
                "type" => $row["type"],
                "str" => $str,
            ];
        }

        return $ret;
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

        $user = Auth::user();
        $profil = $user->profile();

        $bulan = (int) date("m");
        $tahun = (int) date("Y");

        if ($user->role === "orang_tua") {
            $data_notif = [];
            $data_pencapaian = [];
            /*
             * 1) Dapatkan semua anak dari orang tua yang login.
             * 2) Dapatkan 5 pencapaian terbaru dari setiap anak.
             * 3) Tampilkan data pencapaian terbaru.
             */
            $orang_tua = $user->orang_tua();
            $list_anak = $orang_tua->get_all_anak();
            foreach ($list_anak as $anak) {
                $pencapaian = $this->get_pencapaian($anak->id);
                foreach ($pencapaian as $p) {
                    $data_pencapaian[] = $p;
                }

                $unasnwered_harian = $anak->get_unasnwered_harian();
                foreach ($unasnwered_harian as $t) {
                    $data_notif[] = [
                        "tipe_notif" => "harian",
                        "id_siswa"   => $anak->id,
                        "tanggal"    => $t,
                        "str"        => "{$anak->nama}: Monitoring harian tanggal ".fix_id_d($t)." belum diisi!",
                    ];
                }

                $missng_feedback = $anak->get_missing_feedback();
                foreach ($missng_feedback as $m) {
                    $data_notif[] = [
                        "tipe_notif" => "feedback",
                        "id_siswa"   => $anak->id,
                        "tanggal"    => $m->tanggal,
                        "str"        => "{$anak->nama}: Harap isi feedback monitoring {$m->tipe} tanggal ".fix_id_d($m->tanggal)."!",
                        "tipe"       => $m->tipe,
                        "id"         => $m->id,
                    ];
                }
            }


        } else if ($user->role === "guru") {
            $data_notif = [];
            $data_pencapaian = [];

            foreach (Guru::get_unseen_feedback_by_user_id($user->id) as $f) {
                $data_notif[] = [
                    "id"         => $f->id,
                    "tipe_notif" => "feedback_guru",
                    "id_siswa"   => $f->id_siswa,
                    "tanggal"    => $f->tanggal,
                    "str"        => "{$f->nama}: Feedback monitoring {$f->tipe} tanggal ".fix_id_d($f->tanggal),
                    "tipe"       => $f->tipe,
                    "feedback"   => $f->feedback,
                    "nama_ortu"  => $f->nama_ortu,
                ];
            }
        } else {
            $data_notif = [];
            $data_pencapaian = [];
        }
        out:
        return view("home", compact("pengumuman", "guru_lk", "guru_pr", "guru_all",
                                    "siswa_lk", "siswa_pr", "siswa_all", "profil", "data_notif", "data_pencapaian"));
    }

    public function admin()
    {
    }
}

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
use App\Models\Monitoring\HarianYn;

class MonitoringHarianController extends Controller
{
    public function index()
    {
        return view("monitoring.harian.index");
    }

    public function simpan_jawaban(Request $r)
    {
        $r->validate([
            "id_siswa" => "required",
            "tanggal"  => "required",
            "jawaban"  => "required"  
        ]);

        $created_by = Auth::user()->id_orang_tua;
        if (!$created_by) {
            abort(404);
            return;
        }

        HarianIsian::where("id_siswa", $r->id_siswa)
                   ->where("tanggal", $r->tanggal)
                   ->delete();
        
        HarianYn::where("id_siswa", $r->id_siswa)
                   ->where("tanggal", $r->tanggal)
                   ->delete();

        $isian = [];
        $yn = [];
        foreach ($r->jawaban as $k => $j) {
            if (!$j)
                continue;
            $prefix = substr($k, 0, 3);
            if ($prefix !== "hy_" && $prefix !== "hi_")
                continue;
            $id = substr($k, 3);

            $tmp = [
                "id_siswa"   => $r->id_siswa,
                "id_data"    => (int)$id,
                "jawaban"    => $j,
                "created_by" => $created_by,
                "tanggal"    => $r->tanggal,
                "created_at" => date("Y-m-d H:i:s")
            ];

            switch ($prefix) {
                case "hy_":
                    if ($j === "y" || $j === "n")
                        $yn[] = $tmp;
                    break;
                case "hi_":
                    $isian[] = $tmp;
                    break;
                default:
                    break;
            }
        }

        HarianIsian::insert($isian);
        HarianYn::insert($yn);
        $url = route("monitoring.harian.harian");
        $url .= "?ftanggal=".$r->tanggal;
        $url .= "&fsiswa=".$r->id_siswa;
        return redirect($url)->with("success", "Berhasil menyimpan jawaban");
    }

    private function form_isi_orang_tua($user)
    {
        $ftanggal = isset($_GET["ftanggal"]) ? date("Y-m-d", strtotime($_GET["ftanggal"])) : date("Y-m-d");
        $fsiswa = isset($_GET["fsiswa"]) ? (int)$_GET["fsiswa"] : NULL;
        $orang_tua = $user->orang_tua();
        if (!$orang_tua) {
            abort(404);
            return;
        }

        $siswa = $orang_tua->get_all_anak();
        if (count($siswa) === 1) {
            $fsiswa = $siswa[0];
        } else {
            if (!$fsiswa) {
                $fsiswa = $siswa[0];
            } else {
                $fsiswa = Siswa::find($fsiswa);
                if (!$fsiswa) {
                    abort(404);
                    return;
                }
            }
        }

        $harian_isian = HarianIsian::get_pertanyaan_dan_jawaban($fsiswa->id, $ftanggal);
        $harian_yn = HarianYn::get_pertanyaan_dan_jawaban($fsiswa->id, $ftanggal);
        $sel_siswa = $fsiswa;
        return view("monitoring.harian.harian_orang_tua", compact("sel_siswa", "siswa", "fsiswa", "harian_isian", "harian_yn", "ftanggal"));
    }

    private function form_guru($user)
    {
        $ftanggal = isset($_GET["ftanggal"]) ? date("Y-m-d", strtotime($_GET["ftanggal"])) : date("Y-m-d");
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = isset($_GET["fsiswa"]) ? (int)$_GET["fsiswa"] : NULL;

        $user = Auth::user();
        $kelas = $this->get_kelas($user);
        $siswa = $this->get_siswa($fkelas, $user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
        } else {
            $sel_siswa = NULL;
        }

        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        if ($sel_siswa) {
            $harian_isian = HarianIsian::get_pertanyaan_dan_jawaban($sel_siswa->id, $ftanggal);
            $harian_yn = HarianYn::get_pertanyaan_dan_jawaban($sel_siswa->id, $ftanggal);
        } else {
            $harian_isian = $harian_yn = [];
        }
        return view("monitoring.harian.harian_guru",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa", "ftanggal",
                            "mahfudhot", "siswa", "sel_siswa", "harian_isian", "harian_yn"));
    }

    public function form_isi()
    {
        $user = Auth::user();
        if ($user->role === "orang_tua") {
            return $this->form_isi_orang_tua($user);
        } else {
            return $this->form_guru($user);
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
        if ($fkelas && $fkelas !== "all") {
            $siswa = Siswa::select("siswa.*")
                          ->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                          ->where("kelas_siswa.id_kelas", $fkelas)
                          ->get();
        } else {
            $siswa = Siswa::all();
        }
        return $siswa;
    }


}




<?php

namespace App\Http\Controllers;

use URL;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Master\Siswa;
use App\Models\Master\Kelas;
use App\Models\Master\TahunAjaran;
use App\Models\Monitoring\Tahsin;
use App\Models\Monitoring\Mahfudhot;
use App\Models\Monitoring\Hadits;
use App\Models\Monitoring\Doa;
use App\Models\Monitoring\Tahfidz;

class MonitoringRumahController extends Controller
{
    public function index()
    {
        return view("monitoring.rumah.index");
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

    public function tahsin()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $tahsin = Tahsin::where("lokasi", "rumah")
                            ->where("id_siswa", $fsiswa)
                            ->orderBy("created_at", "desc")->get();
        } else {
            $sel_siswa = NULL;
            $tahsin = [];
        }

        $siswa = $this->get_siswa($fkelas, $user);
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.rumah.tahsin",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "tahsin", "siswa", "sel_siswa"));
    }

    public function tahsin_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return NULL;
        }

        $tahsin = Tahsin::find($id);
        if (!$tahsin) {
            abort(404);
            return NULL;
        }

        $tahsin->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data tahsin!');
    }

    public function tahsin_store(Request $r, $id_siswa)
    {
        $r->validate([
            "tipe"       => "required|in:iqro,juz",
            "n"          => "required|integer",
            "halaman"    => "required|integer",
            "lu"         => "required|in:L,U",
            "fkelas"     => "required"
        ]);

        $fkelas = Crypt::decrypt($r->fkelas);
        if (!$fkelas) {
            abort(404);
            return;
        }

        $id_siswa = Crypt::decrypt($id_siswa);
        if (!$id_siswa) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            abort(404);
            return;
        }

        $created_by = $this->get_created_by();
        Tahsin::store([
            "id_siswa"   => $id_siswa,
            "n"          => $r->n,
            "halaman"    => $r->halaman,
            "lu"         => ($r->lu === "L" ? "lancar" : "ulang"),
            "lokasi"     => "rumah",
            "created_by" => $created_by
        ]);
        $url = route('monitoring.rumah.tahsin')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data tahsin!');
    }

    public function tahfidz()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $tahfidz = Tahfidz::where("lokasi", "rumah")
                            ->where("id_siswa", $fsiswa)
                            ->orderBy("created_at", "desc")->get();
        } else {
            $sel_siswa = NULL;
            $tahfidz = [];
        }

        $siswa = $this->get_siswa($fkelas, $user);
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.rumah.tahfidz",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "tahfidz", "siswa", "sel_siswa"));
    }

    public function tahfidz_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return NULL;
        }

        $tahfidz = Tahfidz::find($id);
        if (!$tahfidz) {
            abort(404);
            return NULL;
        }

        $tahfidz->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data tahfidz!');
    }

    public function tahfidz_store(Request $r, $id_siswa)
    {
        $r->validate([
            "surah"      => "required",
            "ayat"       => "required",
            "lu"         => "required|in:L,U",
            "fkelas"     => "required"
        ]);

        $fkelas = Crypt::decrypt($r->fkelas);
        if (!$fkelas) {
            abort(404);
            return;
        }

        $id_siswa = Crypt::decrypt($id_siswa);
        if (!$id_siswa) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            abort(404);
            return;
        }

        $created_by = $this->get_created_by();
        Tahfidz::store([
            "id_siswa"   => $id_siswa,
            "id_surah"   => $r->surah,
            "ayat"       => $r->ayat,
            "lu"         => ($r->lu === "L" ? "lancar" : "ulang"),
            "lokasi"     => "rumah",
            "created_by" => $created_by
        ]);
        $url = route('monitoring.rumah.tahfidz')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data tahfidz!');
    }

    public function mahfudhot()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $mahfudhot = Mahfudhot::where("lokasi", "rumah")
                                ->where("id_siswa", $fsiswa)
                                ->orderBy("created_at", "desc")->get();
        } else {
            $sel_siswa = NULL;
            $mahfudhot = [];
        }

        $siswa = $this->get_siswa($fkelas, $user);
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.rumah.mahfudhot",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "mahfudhot", "siswa", "sel_siswa"));
    }

    public function mahfudhot_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return NULL;
        }

        $mahfudhot = Mahfudhot::find($id);
        if (!$mahfudhot) {
            abort(404);
            return NULL;
        }

        $mahfudhot->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data mahfudhot!');
    }

    public function mahfudhot_store(Request $r, $id_siswa)
    {
        $r->validate([
            "mahfudhot"  => "required",
            "lu"         => "required|in:L,U",
            "fkelas"     => "required"
        ]);

        $fkelas = Crypt::decrypt($r->fkelas);
        if (!$fkelas) {
            abort(404);
            return;
        }

        $id_siswa = Crypt::decrypt($id_siswa);
        if (!$id_siswa) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            abort(404);
            return;
        }

        $created_by = $this->get_created_by();
        Mahfudhot::store([
            "id_siswa"   => $id_siswa,
            "mahfudhot"  => $r->mahfudhot,
            "lu"         => ($r->lu === "L" ? "lancar" : "ulang"),
            "lokasi"     => "rumah",
            "created_by" => $created_by
        ]);
        $url = route('monitoring.rumah.mahfudhot')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data mahfudhot!');
    }

    public function hadits()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $hadits = Hadits::where("lokasi", "rumah")
                            ->where("id_siswa", $fsiswa)
                            ->orderBy("created_at", "desc")->get();
        } else {
            $sel_siswa = NULL;
            $hadits = [];
        }

        $siswa = $this->get_siswa($fkelas, $user);
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.rumah.hadits",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "hadits", "siswa", "sel_siswa"));
    }

    public function hadits_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return NULL;
        }

        $hadits = Hadits::find($id);
        if (!$hadits) {
            abort(404);
            return NULL;
        }

        $hadits->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data hadits!');
    }

    public function hadits_store(Request $r, $id_siswa)
    {
        $r->validate([
            "hadits"  => "required",
            "lu"         => "required|in:L,U",
            "fkelas"     => "required"
        ]);

        $fkelas = Crypt::decrypt($r->fkelas);
        if (!$fkelas) {
            abort(404);
            return;
        }

        $id_siswa = Crypt::decrypt($id_siswa);
        if (!$id_siswa) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            abort(404);
            return;
        }

        $created_by = $this->get_created_by();
        Hadits::store([
            "id_siswa"   => $id_siswa,
            "hadits"  => $r->hadits,
            "lu"         => ($r->lu === "L" ? "lancar" : "ulang"),
            "lokasi"     => "rumah",
            "created_by" => $created_by
        ]);
        $url = route('monitoring.rumah.hadits')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data hadits!');
    }

    public function doa()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $doa = Doa::where("lokasi", "rumah")
                    ->where("id_siswa", $fsiswa)
                    ->orderBy("created_at", "desc")->get();
        } else {
            $sel_siswa = NULL;
            $doa = [];
        }

        $siswa = $this->get_siswa($fkelas, $user);
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.rumah.doa",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "doa", "siswa", "sel_siswa"));
    }

    public function doa_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return NULL;
        }

        $doa = Doa::find($id);
        if (!$doa) {
            abort(404);
            return NULL;
        }

        $doa->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data doa!');
    }

    public function doa_store(Request $r, $id_siswa)
    {
        $r->validate([
            "doa"        => "required",
            "lu"         => "required|in:L,U",
            "fkelas"     => "required"
        ]);

        $fkelas = Crypt::decrypt($r->fkelas);
        if (!$fkelas) {
            abort(404);
            return;
        }

        $id_siswa = Crypt::decrypt($id_siswa);
        if (!$id_siswa) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            abort(404);
            return;
        }

        $created_by = $this->get_created_by();
        Doa::store([
            "id_siswa"   => $id_siswa,
            "doa"        => $r->doa,
            "lu"         => ($r->lu === "L" ? "lancar" : "ulang"),
            "lokasi"     => "rumah",
            "created_by" => $created_by
        ]);
        $url = route('monitoring.rumah.doa')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data doa!');
    }


}




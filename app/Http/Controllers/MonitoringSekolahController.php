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

class MonitoringSekolahController extends Controller
{
    public function index()
    {
        return view("monitoring.sekolah.index");
    }

    public function get_created_by()
    {
        $user = Auth::user();
        if ($user->role === "admin")
            return NULL;

        if ($user->role === "guru")
            return $user->id_guru;

        abort(404);
        return NULL;
    }

    public function tahsin()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $kelas = Kelas::get();

        if ($fkelas && $fsiswa) {
            if (!Siswa::find($fsiswa)) {
                abort(404);
                return;
            }
            $tahsin = Tahsin::where("id_siswa", $fsiswa)->orderBy("created_at", "desc")->get();
        } else {
            $tahsin = [];
        }

        if ($fkelas && $fkelas !== "all") {
            $siswa = Siswa::select("siswa.*");
            $siswa = $siswa->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                        ->where("kelas_siswa.id_kelas", $fkelas)
                        ->get();
        } else {
            $siswa = [];
        }

        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.tahsin",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "tahsin", "siswa"));
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
            "created_by" => $created_by
        ]);
        $url = route('monitoring.sekolah.tahsin')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data tahsin!');
    }

    public function tahfidz()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $kelas  = Kelas::get();

        if ($fkelas && $fsiswa) {
            if (!Siswa::find($fsiswa)) {
                abort(404);
                return;
            }
            $tahfidz = Tahfidz::where("id_siswa", $fsiswa)->orderBy("created_at", "desc")->get();
        } else {
            $tahfidz = [];
        }

        if ($fkelas && $fkelas !== "all") {
            $siswa = Siswa::select("siswa.*");
            $siswa = $siswa->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                        ->where("kelas_siswa.id_kelas", $fkelas)
                        ->get();
        } else {
            $siswa = [];
        }

        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.tahfidz",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "tahfidz", "siswa"));
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
            "created_by" => $created_by
        ]);
        $url = route('monitoring.sekolah.tahfidz')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data tahfidz!');
    }

    public function mahfudhot()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $kelas = Kelas::get();

        if ($fkelas && $fsiswa) {
            if (!Siswa::find($fsiswa)) {
                abort(404);
                return;
            }
            $mahfudhot = Mahfudhot::where("id_siswa", $fsiswa)->orderBy("created_at", "desc")->get();
        } else {
            $mahfudhot = [];
        }

        if ($fkelas && $fkelas !== "all") {
            $siswa = Siswa::select("siswa.*");
            $siswa = $siswa->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                        ->where("kelas_siswa.id_kelas", $fkelas)
                        ->get();
        } else {
            $siswa = [];
        }

        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.mahfudhot",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "mahfudhot", "siswa"));
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
            "created_by" => $created_by
        ]);
        $url = route('monitoring.sekolah.mahfudhot')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data mahfudhot!');
    }

    public function hadits()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $kelas = Kelas::get();

        if ($fkelas && $fsiswa) {
            if (!Siswa::find($fsiswa)) {
                abort(404);
                return;
            }
            $hadits = Hadits::where("id_siswa", $fsiswa)->orderBy("created_at", "desc")->get();
        } else {
            $hadits = [];
        }

        if ($fkelas && $fkelas !== "all") {
            $siswa = Siswa::select("siswa.*");
            $siswa = $siswa->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                        ->where("kelas_siswa.id_kelas", $fkelas)
                        ->get();
        } else {
            $siswa = [];
        }

        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.hadits",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "hadits", "siswa"));
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
            "created_by" => $created_by
        ]);
        $url = route('monitoring.sekolah.hadits')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data hadits!');
    }

    public function doa()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fsiswa = is_string($_GET["fsiswa"] ?? NULL) ? $_GET["fsiswa"] : NULL;
        $kelas = Kelas::get();

        if ($fkelas && $fsiswa) {
            if (!Siswa::find($fsiswa)) {
                abort(404);
                return;
            }
            $doa = Doa::where("id_siswa", $fsiswa)->orderBy("created_at", "desc")->get();
        } else {
            $doa = [];
        }

        if ($fkelas && $fkelas !== "all") {
            $siswa = Siswa::select("siswa.*");
            $siswa = $siswa->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                        ->where("kelas_siswa.id_kelas", $fkelas)
                        ->get();
        } else {
            $siswa = [];
        }

        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.doa",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                            "doa", "siswa"));
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
            "created_by" => $created_by
        ]);
        $url = route('monitoring.sekolah.doa')."?fkelas=".$fkelas."&fsiswa=".$id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data doa!');
    }


}




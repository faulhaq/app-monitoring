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

class MonitoringSekolahController extends Controller
{
    public function index()
    {
        return view("monitoring.sekolah.index");
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
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.tahfidz",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }

    public function mahfudhot()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.mahfudhot",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }

    public function hadits()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.hadits",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }

    public function doa()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.doa",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }


}




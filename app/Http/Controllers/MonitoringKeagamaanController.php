<?php

namespace App\Http\Controllers;

use App\Models\Master\Kelas;
use App\Models\Master\OrangTua;
use App\Models\Master\Siswa;
use App\Models\Master\TahunAjaran;
use App\Models\Monitoring\Doa;
use App\Models\Monitoring\Hadits;
use App\Models\Monitoring\Mahfudhot;
use App\Models\Monitoring\Tahfidz;
use App\Models\Monitoring\Tahsin;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use DB;

class MonitoringKeagamaanController extends Controller
{
    private function handle_mark_as_seen()
    {
        $type = is_string($_GET["type"] ?? NULL) ? $_GET["type"] : NULL;
        $id = is_string($_GET["id_data"] ?? NULL) ? $_GET["id_data"] : NULL;
        if (!$type || !$id) {
            return;
        }

        $pdo = DB::connection()->getPdo();
        $st = $pdo->prepare("UPDATE `monitoring_{$type}` SET `seen_by_ortu` = '1' WHERE `id` = ?");
        $st->execute([$id]);
    }

    public function store_feedback(Request $r)
    {
        $r->validate([
            "tipe_monitoring" => "required|in:tahsin,mahfudhot,hadits,doa,tahfidz",
            "data_id" => "required|integer",
            "feedback" => "required",
        ]);

        $user = Auth::user();
        $data = null;
        if ($user->role === "orang_tua") {
            $orang_tua = OrangTua::find($user->id_orang_tua);
            if (!$orang_tua) {
                abort(404);
                return;
            }

            $feedback_by = $orang_tua->id;
            if ($r->tipe_monitoring === "tahsin") {
                $data = Tahsin::find($r->data_id);
            } else if ($r->tipe_monitoring === "mahfudhot") {
                $data = Mahfudhot::find($r->data_id);
            } else if ($r->tipe_monitoring === "hadits") {
                $data = Hadits::find($r->data_id);
            } else if ($r->tipe_monitoring === "doa") {
                $data = Doa::find($r->data_id);
            } else if ($r->tipe_monitoring === "tahfidz") {
                $data = Tahfidz::find($r->data_id);
            } else {
                abort(404);
                return;
            }

        } else if ($user->role === "guru") {
            $guru = OrangTua::find($user->id_guru);
            if (!$guru) {
                abort(404);
                return;
            }

            $feedback_by = $guru->id;

            // TODO(): Handle monitoring harian.

        } else {
            abort(404);
            return;
        }

        if (!$data) {
            abort(404);
            return;
        }

        $data->update([
            "feedback_by" => $feedback_by,
            "feedback" => $r->feedback,
        ]);

        $url = URL::previous();
        if (strpos($url, "?") !== false) {
            $url .= "&skip_feedback=1";
        }

        return redirect($url)->with('success', 'Berhasil mengirimkan feedback');
    }

    public function index()
    {
        $menu = [
            "Tahsin" => "bg-primary",
            "Tahfidz" => "bg-info",
            "Mahfudhot" => "bg-success",
            "Hadits" => "bg-warning",
            "Doa" => "bg-secondary",
        ];

        return view("monitoring.keagamaan.index", compact("menu"));
    }

    public function get_created_by()
    {
        $user = Auth::user();
        if ($user->role === "admin") {
            return null;
        }

        if ($user->role === "guru") {
            return $user->id;
        }

        abort(404);
        return null;
    }

    private function get_kelas($user)
    {
        if ($user->role !== "orang_tua") {
            return Kelas::get();
        }

        return null;
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
            $siswa = Siswa::all();
        }
        return $siswa;
    }

    public function tahsin()
    {
        $fkelas = is_string($_GET["fkelas"] ?? null) ? $_GET["fkelas"] : null;
        $fsiswa = is_string($_GET["fsiswa"] ?? null) ? $_GET["fsiswa"] : null;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);
        $siswa = $this->get_siswa($fkelas, $user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $tahsin = Tahsin::where("id_siswa", $fsiswa)
                ->orderBy("tanggal", "desc")->get();
        } else {
            $sel_siswa = null;
            $tahsin = [];
            if ($user->role === "orang_tua" && count($siswa) == 1) {
                return redirect(route("monitoring.keagamaan.tahsin") . "?fkelas=-1&fsiswa={$siswa[0]->id}");
            }
        }

        $this->handle_mark_as_seen();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.keagamaan.tahsin",
            compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                "tahsin", "siswa", "sel_siswa"));
    }

    public function tahsin_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return null;
        }

        $tahsin = Tahsin::find($id);
        if (!$tahsin) {
            abort(404);
            return null;
        }

        $tahsin->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data tahsin!');
    }

    public function tahsin_store(Request $r, $id_siswa)
    {
        $r->validate([
            "tipe" => "required|in:iqro,juz",
            "n" => "required|integer",
            "halaman" => "required|string",
            "lu" => "required|in:L,U",
            "catatan" => "string|nullable",
            "fkelas" => "required",
            "tanggal" => "required|date|date_format:Y-m-d|before:tomorrow|after:1900-01-01",
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
            "id_siswa" => $id_siswa,
            "n" => $r->n,
            "halaman" => $r->halaman,
            "lu" => ($r->lu === "L" ? "lancar" : "ulang"),
            "catatan" => $r->catatan,
            "tanggal" => $r->tanggal,
            "created_by" => $created_by,
        ]);
        $url = route('monitoring.keagamaan.tahsin') . "?fkelas=" . $fkelas . "&fsiswa=" . $id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data tahsin!');
    }

    public function tahfidz()
    {
        $fkelas = is_string($_GET["fkelas"] ?? null) ? $_GET["fkelas"] : null;
        $fsiswa = is_string($_GET["fsiswa"] ?? null) ? $_GET["fsiswa"] : null;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);
        $siswa = $this->get_siswa($fkelas, $user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $tahfidz = Tahfidz::where("id_siswa", $fsiswa)
                ->orderBy("tanggal", "desc")->get();
        } else {
            $sel_siswa = null;
            $tahfidz = [];
            if ($user->role === "orang_tua" && count($siswa) == 1) {
                return redirect(route("monitoring.keagamaan.tahfidz") . "?fkelas=-1&fsiswa={$siswa[0]->id}");
            }
        }

        $this->handle_mark_as_seen();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.keagamaan.tahfidz",
            compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                "tahfidz", "siswa", "sel_siswa"));
    }

    public function tahfidz_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return null;
        }

        $tahfidz = Tahfidz::find($id);
        if (!$tahfidz) {
            abort(404);
            return null;
        }

        $tahfidz->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data tahfidz!');
    }

    public function tahfidz_store(Request $r, $id_siswa)
    {
        $r->validate([
            "surah" => "required",
            "ayat" => "required",
            "lu" => "required|in:L,U",
            "catatan" => "string|nullable",
            "fkelas" => "required",
            "tanggal" => "required|date|date_format:Y-m-d|before:tomorrow|after:1900-01-01",
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
            "id_siswa" => $id_siswa,
            "id_surah" => $r->surah,
            "ayat" => $r->ayat,
            "lu" => ($r->lu === "L" ? "lancar" : "ulang"),
            "catatan" => $r->catatan,
            "tanggal" => $r->tanggal,
            "created_by" => $created_by,
        ]);
        $url = route('monitoring.keagamaan.tahfidz') . "?fkelas=" . $fkelas . "&fsiswa=" . $id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data tahfidz!');
    }

    public function mahfudhot()
    {
        $fkelas = is_string($_GET["fkelas"] ?? null) ? $_GET["fkelas"] : null;
        $fsiswa = is_string($_GET["fsiswa"] ?? null) ? $_GET["fsiswa"] : null;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);
        $siswa = $this->get_siswa($fkelas, $user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $mahfudhot = Mahfudhot::where("id_siswa", $fsiswa)
                ->orderBy("tanggal", "desc")->get();
        } else {
            $sel_siswa = null;
            $mahfudhot = [];
            if ($user->role === "orang_tua" && count($siswa) == 1) {
                return redirect(route("monitoring.keagamaan.mahfudhot") . "?fkelas=-1&fsiswa={$siswa[0]->id}");
            }
        }

        $this->handle_mark_as_seen();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.keagamaan.mahfudhot",
            compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                "mahfudhot", "siswa", "sel_siswa"));
    }

    public function mahfudhot_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return null;
        }

        $mahfudhot = Mahfudhot::find($id);
        if (!$mahfudhot) {
            abort(404);
            return null;
        }

        $mahfudhot->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data mahfudhot!');
    }

    public function mahfudhot_store(Request $r, $id_siswa)
    {
        $r->validate([
            "id_mahfudhot" => "required|string",
            "lu" => "required|in:L,U",
            "fkelas" => "required|string",
            "tanggal" => "required|date|date_format:Y-m-d|before:tomorrow|after:1900-01-01",
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
            "id_siswa" => $id_siswa,
            "id_mahfudhot" => $r->id_mahfudhot,
            "lu" => ($r->lu === "L" ? "lancar" : "ulang"),
            "tanggal" => $r->tanggal,
            "created_by" => $created_by,
        ]);
        $url = route('monitoring.keagamaan.mahfudhot') . "?fkelas=" . $fkelas . "&fsiswa=" . $id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data mahfudhot!');
    }

    public function hadits()
    {
        $fkelas = is_string($_GET["fkelas"] ?? null) ? $_GET["fkelas"] : null;
        $fsiswa = is_string($_GET["fsiswa"] ?? null) ? $_GET["fsiswa"] : null;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);
        $siswa = $this->get_siswa($fkelas, $user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $hadits = Hadits::where("id_siswa", $fsiswa)
                ->orderBy("tanggal", "desc")->get();
        } else {
            $sel_siswa = null;
            $hadits = [];
            if ($user->role === "orang_tua" && count($siswa) == 1) {
                return redirect(route("monitoring.keagamaan.hadits") . "?fkelas=-1&fsiswa={$siswa[0]->id}");
            }
        }

        $this->handle_mark_as_seen();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.keagamaan.hadits",
            compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                "hadits", "siswa", "sel_siswa"));
    }

    public function hadits_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return null;
        }

        $hadits = Hadits::find($id);
        if (!$hadits) {
            abort(404);
            return null;
        }

        $hadits->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data hadits!');
    }

    public function hadits_store(Request $r, $id_siswa)
    {
        $r->validate([
            "id_hadits" => "required",
            "lu" => "required|in:L,U",
            "fkelas" => "required",
            "tanggal" => "required|date|date_format:Y-m-d|before:tomorrow|after:1900-01-01",
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
            "id_siswa" => $id_siswa,
            "id_hadits" => $r->id_hadits,
            "lu" => ($r->lu === "L" ? "lancar" : "ulang"),
            "tanggal" => $r->tanggal,
            "created_by" => $created_by,
        ]);
        $url = route('monitoring.keagamaan.hadits') . "?fkelas=" . $fkelas . "&fsiswa=" . $id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data hadits!');
    }

    public function doa()
    {
        $fkelas = is_string($_GET["fkelas"] ?? null) ? $_GET["fkelas"] : null;
        $fsiswa = is_string($_GET["fsiswa"] ?? null) ? $_GET["fsiswa"] : null;
        $user = Auth::user();
        $kelas = $this->get_kelas($user);
        $siswa = $this->get_siswa($fkelas, $user);

        if ($fkelas && $fsiswa) {
            $sel_siswa = Siswa::find($fsiswa);
            if (!$sel_siswa) {
                abort(404);
                return;
            }
            $doa = Doa::where("id_siswa", $fsiswa)
                ->orderBy("tanggal", "desc")->get();
        } else {
            $sel_siswa = null;
            $doa = [];
            if ($user->role === "orang_tua" && count($siswa) == 1) {
                return redirect(route("monitoring.keagamaan.doa") . "?fkelas=-1&fsiswa={$siswa[0]->id}");
            }
        }

        $this->handle_mark_as_seen();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.keagamaan.doa",
            compact("kelas", "id_tahun_ajaran_aktif", "fkelas", "fsiswa",
                "doa", "siswa", "sel_siswa"));
    }

    public function doa_destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return null;
        }

        $doa = Doa::find($id);
        if (!$doa) {
            abort(404);
            return null;
        }

        $doa->delete();
        $url = URL::previous();
        return redirect($url)->with('success', 'Berhasil menghapus data doa!');
    }

    public function doa_store(Request $r, $id_siswa)
    {
        $r->validate([
            "id_doa" => "required",
            "lu" => "required|in:L,U",
            "fkelas" => "required",
            "tanggal" => "required|date|date_format:Y-m-d|before:tomorrow|after:1900-01-01",
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
            "id_siswa" => $id_siswa,
            "id_doa" => $r->id_doa,
            "lu" => ($r->lu === "L" ? "lancar" : "ulang"),
            "tanggal" => $r->tanggal,
            "created_by" => $created_by,
        ]);
        $url = route('monitoring.keagamaan.doa') . "?fkelas=" . $fkelas . "&fsiswa=" . $id_siswa;
        return redirect($url)->with('success', 'Berhasil menambahkan data doa!');
    }

}

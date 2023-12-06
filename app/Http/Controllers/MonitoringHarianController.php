<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Master\OrangTua;
use App\Models\Master\Siswa;
use App\Models\Master\Kelas;
use App\Models\Master\Harian;
use App\Models\Master\TahunAjaran;
use App\Models\Monitoring\Harian as MonitoringHarian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class MonitoringHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("monitoring.harian.index");
    }

    public function index2_orang_tua($user)
    {
        $orang_tua = $user->orang_tua();
        if (!$orang_tua) {
            abort(404);
            return;
        }

        $fsiswa = NULL;
        $siswa = NULL;
        $pertanyaan = [];
        $jawaban = [];

        if (isset($_GET["ftanggal"])) {
            if ($_GET["ftanggal"] !== date("Y-m-d", strtotime($_GET["ftanggal"]))) {
                abort(404);
                return;
            }
            $ftanggal = $_GET["ftanggal"];
        } else {
            $ftanggal = date("Y-m-d");
        }

        if (isset($_GET["fsiswa"]) && is_numeric($_GET["fsiswa"])) {
            $fsiswa = (int) $_GET["fsiswa"];

            if (!$orang_tua->validate_anak($fsiswa)) {
                abort(404);
                return;
            }

            $siswa = Siswa::find($fsiswa);
            if (!$siswa) {
                abort(404);
                return;
            }

            $kelas = $siswa->kelas();

            $epoch = strtotime($ftanggal);
            $month_now = (int) date("m", $epoch);
            $year_now = (int) date("Y", $epoch);
            $bulan = $month_now;
            $tahun = $year_now;

            $harian = Harian::where("id_kelas", $kelas->id)
                            ->where("tahun", $year_now)
                            ->where("bulan", $month_now)
                            ->first();
            
            if ($harian) {
                $pertanyaan = $harian->get_all_pertanyaan();
                $list_jawaban = MonitoringHarian::where("id_siswa", $fsiswa)->where("tanggal", $ftanggal)->get();
                foreach ($pertanyaan as $p) {
                    $found = false;
                    foreach ($list_jawaban as $j) {
                        if ($p->id == $j->id_pertanyaan) {
                            $found = true;
                            break;
                        }
                    }

                    if ($found) {
                        $jawaban[] = $j;
                    } else {
                        $jawaban[] = "";
                    }
                }
            }
        }

        $list_siswa = $orang_tua->get_all_anak();
        if (count($list_siswa) === 1 && !$fsiswa) {
            return redirect(route("monitoring.harian.index2")."?fsiswa={$list_siswa[0]->id}");
        }

        return view("monitoring.harian.orang_tua.index",
                    compact("tahun", "bulan", "orang_tua", "list_siswa", "siswa",
                            "fsiswa", "ftanggal", "pertanyaan", "jawaban"));
    }

    public function index2_guru($user)
    {
        $pertanyaan = [];
        $jawaban = [];
        $list_siswa = [];
        $ftanggal = date("Y-m-d");
        $fkelas = NULL;
        $kelas = NULL;
        $fsiswa = NULL;

        if ($user->role === "admin") {
            $list_kelas = Kelas::all();
        } else if ($user->role === "guru") {
            $guru = $user->guru();
            if (!$guru) {
                abort(404);
                return;
            }
            $list_kelas = Kelas::where("id_guru", $guru->id)->get();
        } else {
            abort(404);
            return;
        }

        if (isset($_GET["fkelas"])) {
            if (is_numeric($_GET["fkelas"])) {
                $fkelas = (int) $_GET["fkelas"];
                $kelas = Kelas::find($fkelas);
                if (!$kelas) {
                    abort(404);
                    return;
                }
                $list_siswa = Siswa::get_siswa_by_id_kelas($kelas->id)->get();
            }
        }

        if (!$fkelas && count($list_kelas) === 1) {
            return redirect(route("monitoring.harian.index2")."?fkelas={$list_kelas[0]->id}");
        }

        if (isset($kelas) && isset($_GET["fsiswa"]) && is_numeric($_GET["fsiswa"])) {
            if (empty($list_siswa)) {
                abort(404);
                return;
            }

            /**
             * Pastikan $fsiswa berada dalam $list_siswa.
             */
            $found = false;
            foreach ($list_siswa as $s) {
                if ($s->id == $_GET["fsiswa"]) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                abort(404);
                return;
            }

            $fsiswa = (int) $_GET["fsiswa"];
            $siswa = Siswa::find($fsiswa);
            if (!$siswa) {
                abort(404);
                return;
            }

            if (isset($_GET["ftanggal"]) && is_string($_GET["ftanggal"])) {
                $tmp = $_GET["ftanggal"];
                if (date("Y-m-d", strtotime($tmp)) !== $tmp) {
                    abort(404);
                    return;
                }
    
                $ftanggal = $tmp;
            }

            $epoch = strtotime($ftanggal);
            $month_now = (int) date("m", $epoch);
            $year_now = (int) date("Y", $epoch);
            $bulan = $month_now;
            $tahun = $year_now;

            $harian = Harian::where("id_kelas", $kelas->id)
                            ->where("tahun", $year_now)
                            ->where("bulan", $month_now)
                            ->first();

            if ($harian) {
                $pertanyaan = $harian->get_all_pertanyaan();
                $list_jawaban = MonitoringHarian::where("id_siswa", $fsiswa)->where("tanggal", $ftanggal)->get();
                foreach ($pertanyaan as $p) {
                    $found = false;
                    foreach ($list_jawaban as $j) {
                        if ($p->id == $j->id_pertanyaan) {
                            $found = true;
                            break;
                        }
                    }

                    if ($found) {
                        $jawaban[] = $j;
                    } else {
                        $jawaban[] = "";
                    }
                }
            }
        }

        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.harian.guru.index",
                   compact("list_kelas", "list_siswa", "fkelas", "ftanggal",
                           "kelas", "fsiswa", "siswa", "id_tahun_ajaran_aktif",
                           "user", "pertanyaan", "jawaban", "bulan", "tahun"));
    }

    public function index2()
    {
        $user = Auth::user();
        if (!$user) {
            abort(404);
            return;
        }

        if ($user->role === "orang_tua") {
            return $this->index2_orang_tua($user);
        } else if ($user->role === "guru" || $user->role === "admin") {
            return $this->index2_guru($user);
        } else {
            abort(404);
            return;
        }
    }

    public function simpan_jawaban(Request $r)
    {
        $r->validate([
            "id_siswa" => "required",
            "tanggal"  => "required"
        ]);

        $user = Auth::user();
        if (!$user) {
            abort(404);
            return;
        }

        if ($user->role !== "orang_tua") {
            abort(404);
            return;
        }

        $siswa = Siswa::find($r->id_siswa);
        if (!$siswa) {
            abort(404);
            return;
        }

        $orang_tua = $user->orang_tua();
        if (!$orang_tua) {
            abort(404);
            return;
        }

        if (!$orang_tua->validate_anak($siswa->id)) {
            abort(404);
            return;
        }

        DB::beginTransaction();
        $kelas = $siswa->kelas();
        $epoch = strtotime($r->tanggal);
        $month_now = (int) date("m", $epoch);
        $year_now = (int) date("Y", $epoch);
        $harian = Harian::where("id_kelas", $kelas->id)
                        ->where("tahun", $year_now)
                        ->where("bulan", $month_now)
                        ->first();
        
        if (!$harian) {
            DB::rollBack();
            abort(404);
            return;
        }

        $pertanyaan = $harian->get_all_pertanyaan();
        $jawaban = [];
        foreach ($pertanyaan as $p) {
            if (!isset($r->jawaban[$p->id]) || !is_string($r->jawaban[$p->id])) {
                continue;
            }

            if (empty($r->jawaban[$p->id])) {
                continue;
            }

            $jawaban[] = [
                "id_siswa"      => $siswa->id,
                "id_pertanyaan" => $p->id,
                "jawaban"       => $r->jawaban[$p->id],
                "tanggal"       => $r->tanggal,
                "created_by"    => $orang_tua->id,
                "created_at"    => date("Y-m-d H:i:s")
            ];
        }

        MonitoringHarian::where("id_siswa", $siswa->id)->where("tanggal", $r->tanggal)->delete();
        if (count($jawaban) > 0) {
            MonitoringHarian::insert($jawaban);
        }
        DB::commit();

        $url = "";
        $url .= route("monitoring.harian.index2");
        $url .= "?fsiswa={$siswa->id}&ftanggal={$r->tanggal}";
        return redirect($url)->with("success", "Berhasil menyimpan jawaban!");
    }

    public function calendar($id_siswa)
    {
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

        $kelas = $siswa->kelas();
        if (!$kelas) {
            abort(404);
            return;
        }

        if (isset($_GET["tahun"]) && is_numeric($_GET["tahun"])) {
            $tahun = (int) $_GET["tahun"];
        } else {
            $tahun = (int) date("Y");
        }

        if (isset($_GET["kelas"]) && is_numeric($_GET["kelas"])) {
            $fkelas = (int) $_GET["kelas"];
        } else {
            $fkelas = NULL;
        }

        if (isset($_GET["bulan"]) && is_numeric($_GET["bulan"])) {
            $bulan = (int) $_GET["bulan"];
        } else {
            $bulan = (int) date("m");
        }

        $harian = Harian::where("id_kelas", $kelas->id)
                        ->where("tahun", $tahun)
                        ->where("bulan", $bulan)
                        ->first();
        if (!$harian) {
            $all_false = true;
        } else {
            $all_false = false;
            $jawaban = MonitoringHarian::where("id_siswa", $siswa->id)
                        ->where("tanggal", "LIKE", "{$tahun}-".sprintf("%02d", $bulan)."-%")
                        ->get();
        }

        $list_tanggal = [];
        for ($i = 1; $i <= 31; $i++) {
            $dt = "{$tahun}-".sprintf("%02d", $bulan)."-".sprintf("%02d", $i);
            $ep = strtotime($dt);
            if (date("Y-m-d", $ep) !== $dt)
                continue;

            if ($all_false) {
                $list_tanggal[$dt] = false;
                continue;
            }

            $found = false;
            foreach ($jawaban as $j) {
                if ($j->tanggal === $dt) {
                    $found = true;
                    break;
                }
            }

            $list_tanggal[$dt] = $found;
        }
        return view("monitoring.harian.orang_tua.calendar", compact("fkelas", "siswa", "bulan", "tahun", "list_tanggal")); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

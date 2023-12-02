<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Master\OrangTua;
use App\Models\Master\Siswa;
use App\Models\Master\Kelas;
use App\Models\Master\Harian;

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

            $harian = Harian::where("id_kelas", $kelas->id)
                            ->where("tahun", $year_now)
                            ->where("bulan", $month_now)
                            ->first();
            
            if ($harian)
                $pertanyaan = $harian->get_all_pertanyaan();
        }

        $list_siswa = $orang_tua->get_all_anak();
        if (count($list_siswa) === 1 && !$fsiswa) {
            return redirect(route("monitoring.harian.index2")."?fsiswa={$list_siswa[0]->id}");
        }
        
        return view("monitoring.harian.orang_tua.index", compact("orang_tua", "list_siswa", "siswa", "fsiswa", "ftanggal", "pertanyaan"));
    }

    public function index2_guru($user)
    {

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

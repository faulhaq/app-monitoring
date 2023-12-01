<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Kelas;
use App\Models\Master\Harian;
use App\Models\Master\PertanyaanHarian;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $harian = Harian::all();
        return view("master_data.harian.index", compact("harian"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fkelas = NULL;
        $ftahun = NULL;
        $list_bulan = [];
        $list_tahun = [];

        if (!empty($_GET["fkelas"]) && is_numeric($_GET["fkelas"])) {
            $fkelas = (int)$_GET["fkelas"];
            $kelas = Kelas::find($fkelas);
            if (!$kelas) {
                abort(404);
                return;
            }

            $list_tahun = Harian::get_list_tahun_by_kelas($kelas->id);

            if (!empty($_GET["ftahun"]) && is_numeric($_GET["ftahun"])) {
                $ftahun = (int)$_GET["ftahun"];
                $list_bulan = Harian::get_list_bulan_by_kelas_and_tahun($kelas->id, $ftahun);
            }
        }

        $kelas = Kelas::get_kelas_aktif();
        return view("master_data.harian.create", compact("kelas", "fkelas", "list_tahun", "ftahun", "list_bulan"));
    }

    private function gather_input(Request $r)
    {
        $year_now = (int)date("Y");
        $tahun = (int)$r->tahun;
        if (!is_numeric($tahun) || $tahun < $year_now || $tahun >= 2100) {
            return redirect()->back()->with('error', 'Tahun salah');
        }

        $bulan = $r->bulan;
        if (!is_numeric($bulan)) {
            return redirect()->back()->with('error', 'Bulan salah');
        }

        $bulan = (int)$bulan;
        if ($bulan < 1 || $bulan > 12) {
            return redirect()->back()->with('error', 'Bulan salah');
        }

        $pertanyaan = (array) $r->pertanyaan;
        $jenis_pertanyaan = (array) $r->jenis_pertanyaan;

        foreach ($pertanyaan as $k => $p) {
            if (empty($p))
                unset($pertanyaan[$k]);
        }

        foreach ($jenis_pertanyaan as $k => $p) {
            if (empty($p))
                unset($jenis_pertanyaan[$k]);
        }

        return [$pertanyaan, $jenis_pertanyaan, $tahun, $bulan];
    }

    private function save_pertanyaan($harian, $pertanyaan, $jenis_pertanyaan)
    {
        $data = [];
        foreach ($pertanyaan as $k => $p) {
            if (!isset($jenis_pertanyaan[$k]) || !in_array($jenis_pertanyaan[$k], ["opsi", "isian"])) {
                return false;
            }

            $jenis = $jenis_pertanyaan[$k];
            if ($jenis === "isian") {
                $list_opsi = NULL;
            } else {
                $list_opsi = json_encode(["ya", "tidak"]);
            }

            $data[] = [
                "id_data_harian" => $harian->id,
                "pertanyaan"     => $p,
                "tipe"           => $jenis,
                "list_opsi"      => $list_opsi,
                "created_at"     => date("Y-m-d H:i:s")
            ];
        }

        PertanyaanHarian::insert($data);
        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $r->validate([
            "tujuan_kelas"      => "required",
            "tahun"             => "required",
            "bulan"             => "required",
        ]);

        $kelas = Kelas::find($r->tujuan_kelas);
        if (!$kelas) {
            abort(404);
            return;
        }

        $ret = $this->gather_input($r);
        if (!is_array($ret)) {
            return $ret;
        }
        [$pertanyaan, $jenis_pertanyaan, $tahun, $bulan] = $ret;

        if (count($pertanyaan) !== count($jenis_pertanyaan)) {
            return redirect()->back()->with('error', 'Jumlah pertanyaan tidak sesuai dengan jenis pertanyaan');
        }

        $harian = Harian::where("id_kelas", $kelas->id)
                        ->where("tahun", $tahun)
                        ->where("bulan", $bulan)
                        ->first();
        if ($harian) {
            return redirect()->back()->with('error', 'Kombinasi kelas, tahun dan bulan sudah ada, silakan edit di index');
        }

        DB::beginTransaction();
        $harian = Harian::create([
            "id_kelas" => $kelas->id,
            "tahun"    => $tahun,
            "bulan"    => $bulan
        ]);

        if (!$this->save_pertanyaan($harian, $pertanyaan, $jenis_pertanyaan)) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Invalid form data');
        }

        DB::commit();
        return redirect(route("harian.index"))->with('success', 'Berhasil menambahkan data pertanyaan harian');
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
        $id_data_harian = Crypt::decrypt($id);
        if (!$id_data_harian) {
            abort(404);
            return;
        }

        $harian = Harian::find($id_data_harian);
        if (!$harian) {
            abort(404);
            return;
        }

        $pertanyaan = PertanyaanHarian::where("id_data_harian", $harian->id)->get();
        return view("master_data.harian.edit", compact("harian", "pertanyaan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $r
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $r->validate([
            "tujuan_kelas"      => "required",
            "tahun"             => "required",
            "bulan"             => "required",
        ]);

        $kelas = Kelas::find($r->tujuan_kelas);
        if (!$kelas) {
            abort(404);
            return;
        }

        $id_data_harian = Crypt::decrypt($id);
        if (!$id_data_harian) {
            DB::rollBack();
            abort(404);
            return;
        }

        $ret = $this->gather_input($r);
        if (!is_array($ret)) {
            return $ret;
        }
        [$pertanyaan, $jenis_pertanyaan, $tahun, $bulan] = $ret;

        DB::beginTransaction();
        $harian = Harian::find($id_data_harian);
        if (!$harian) {
            DB::rollBack();
            abort(404);
            return;
        }

        PertanyaanHarian::where("id_data_harian", $harian->id)->delete();
        if (!$this->save_pertanyaan($harian, $pertanyaan, $jenis_pertanyaan)) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Invalid form data');
        }

        DB::commit();
        return redirect(route("harian.index"))->with('success', 'Berhasil mengubah data pertanyaan harian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            abort(404);
            return;
        }

        $harian = Harian::find($id);
        if (!$harian) {
            abort(404);
            return;
        }

        $harian->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data harian');
    }
}

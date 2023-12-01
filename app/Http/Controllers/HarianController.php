<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Kelas;
use App\Models\Master\Harian;
use App\Models\Master\HarianPertanyaan;
use Illuminate\Support\Facades\Crypt;

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

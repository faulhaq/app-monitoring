<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\TahunAjaran;
use DB;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::get();
        return view("master_data.tahun_ajaran.index", compact("tahun_ajaran"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
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
            "tahun"  => "required|unique:tahun_ajaran",
            "status" => "required|in:aktif,non-aktif"
        ]);

        TahunAjaran::create([
            "tahun"  => $r->tahun,
            "status" => $r->status,
        ]);
        return redirect()->back()->with('success', 'Berhasil menambahkan data tahun ajaran!');
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

    public function aktifkan_tahun(Request $r)
    {
        $r->validate([
            "tahun" => "required"
        ]);

        DB::table("tahun_ajaran_aktif")->delete();
        DB::table("tahun_ajaran_aktif")->insert([
           "id_tahun_ajaran" => $r->tahun 
        ]);
        return redirect()->back()->with('success', 'Berhasil mengubah tahun aktif!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Kelas;
use App\Models\Master\TahunAjaran;
use App\Models\Master\Guru;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::get_kelas_aktif();
        $tahun_ajaran = TahunAjaran::get();
        $guru = Guru::get();
        return view("master_data.kelas.index", compact("kelas", "tahun_ajaran", "guru"));
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
            "tingkatan"     => "required",
            "nama"          => "required",
            "tahun_ajaran"  => "required",
            "wali_kelas"    => "required"
        ]);

        Kelas::create([
            "tingkatan"        => $r->tingkatan,
            "nama"             => $r->nama,
            "id_tahun_ajaran"  => $r->tahun_ajaran,
            "id_guru"          => $r->wali_kelas
        ]);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
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
        $id = Crypt::decrypt($id);
        $kelas = Kelas::find($id);
        if (!$kelas) {
            abort(404);
            return;
        }

        $tahun_ajaran = TahunAjaran::get();
        $guru = Guru::get();
        return view("master_data.kelas.edit", compact("kelas", "tahun_ajaran", "guru"));
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
            "tingkatan"     => "required",
            "nama"          => "required",
            "tahun_ajaran"  => "required",
            "wali_kelas"    => "required"
        ]);

        $id = Crypt::decrypt($id);
        $kelas = Kelas::find($id);
        if (!$kelas) {
            abort(404);
            return;
        }

        // dd($r->toArray());
        $kelas->update([
            "tingkatan"        => $r->tingkatan,
            "nama"             => $r->nama,
            "id_tahun_ajaran"  => $r->tahun_ajaran,
            "id_guru"          => $r->wali_kelas
        ]);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diubah!');
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

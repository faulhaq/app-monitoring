<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\HarianYn;
use App\Models\Master\Kelas;
use Illuminate\Support\Facades\Crypt;

class HarianYnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $harian = HarianYn::all();
        return view("master_data.harian_yn.index", compact("harian"));
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
    public function store(Request $r)
    {
        $r->validate([
            "pertanyaan"  => 'required',
            "tgl_mulai"   => 'required',
            "tgl_selesai" => 'required'
        ]);

        if ($r->tujuan_kelas) {
            foreach ($r->tujuan_kelas as $id_kelas) {
                $kelas = Kelas::find($id_kelas);
                if (!$kelas) {
                    abort(404);
                    return;
                }
            }
        }

        $harian = HarianYn::create([
            "pertanyaan" => $r->pertanyaan,
            "tgl_mulai"   => $r->tgl_mulai,
            "tgl_selesai" => $r->tgl_selesai
        ]);
        HarianYn::apply_kelas($harian->id, $r->tujuan_kelas);
        return redirect()->back()->with('success', 'Berhasil menambahkan data harian pilihan baru!');
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
        $id_data = Crypt::decrypt($id);
        if (!$id_data) {
            abort(404);
            return;
        }

        $harian = HarianYn::find($id_data);
        if (!$harian) {
            abort(404);
            return;
        }

        $tujuan_kelas = HarianYn::get_tujuan_kelas($harian->id);
        return view("master_data.harian_yn.edit", compact("harian", "tujuan_kelas"));
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
            "pertanyaan"  => 'required',
            "tgl_mulai"   => 'required',
            "tgl_selesai" => 'required'
        ]);

        $id_data = Crypt::decrypt($id);
        if (!$id_data) {
            abort(404);
            return;
        }

        $harian = HarianYn::find($id_data);
        if (!$harian) {
            abort(404);
            return;
        }

        $harian->update([
            "pertanyaan" => $r->pertanyaan,
            "tgl_mulai"   => $r->tgl_mulai,
            "tgl_selesai" => $r->tgl_selesai
        ]);
        HarianYn::apply_kelas($harian->id, $r->tujuan_kelas);
        return redirect(route("harian_yn.index"))->with('success', 'Berhasil mengubah data harian yn!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_data = Crypt::decrypt($id);
        if (!$id_data) {
            abort(404);
            return;
        }

        $harian = HarianYn::find($id_data);
        if (!$harian) {
            abort(404);
            return;
        }

        $harian->delete();
        return redirect(route("harian_yn.index"))->with('success', 'Berhasil menghapus data harian yn!');
    }
}

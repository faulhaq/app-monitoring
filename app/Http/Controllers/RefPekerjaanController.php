<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Ref\Pekerjaan;

class RefPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerjaan = Pekerjaan::orderBy("nama", "asc")->get();
        return view("data_ref.pekerjaan.index", compact("pekerjaan"));
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
            "nama" => "required|unique:pekerjaan"
        ]);

        Pekerjaan::create(["nama" => $r->nama]);
        return redirect()->back()->with('success', 'Berhasil menambahkan data ref pekerjaan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
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
        $pekerjaan = Pekerjaan::find($id);
        if (!$pekerjaan) {
            abort(404);
            return;
        }
        return view("data_ref.pekerjaan.edit", compact("pekerjaan"));
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
        $id = Crypt::decrypt($id);
        $pekerjaan = Pekerjaan::find($id);
        if (!$pekerjaan) {
            abort(404);
            return;
        }

        if (!($r->nama ?? NULL)) {
            abort(404);
            return;
        }

        if ($r->nama == $pekerjaan->nama) {
            goto out;
        }

        $r->validate([
            "nama" => "required|unique:pekerjaan"
        ]);

        $pekerjaan->update(["nama" => $r->nama]);
    out:
        return redirect(route("data_ref.pekerjaan.index"))->with('success', 'Berhasil mengubah data ref pekerjaan!');
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
        $pekerjaan = Pekerjaan::find($id);
        if (!$pekerjaan) {
            abort(404);
            return;
        }
        $pekerjaan->delete();
        return redirect(route("data_ref.pekerjaan.index"))->with('success', 'Berhasil menghapus data ref pekerjaan!');
    }
}

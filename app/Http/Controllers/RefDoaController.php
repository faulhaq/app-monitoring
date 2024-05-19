<?php

namespace App\Http\Controllers;

use App\Models\Ref\Doa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RefDoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doa = Doa::orderBy("nama", "asc")->get();
        return view("data_ref.doa.index", compact("doa"));
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
            "nama" => "required|unique:doa"
        ]);

        Doa::create(["nama" => $r->nama]);
        return redirect()->back()->with('success', 'Berhasil menambahkan data ref doa!');
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
        $doa = Doa::find($id);
        if (!$doa) {
            abort(404);
            return;
        }
        return view("data_ref.doa.edit", compact("doa"));
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
        $doa = Doa::find($id);
        if (!$doa) {
            abort(404);
            return;
        }

        if (!($r->nama ?? NULL)) {
            abort(404);
            return;
        }

        if ($r->nama == $doa->nama) {
            goto out;
        }

        $r->validate([
            "nama" => "required|unique:doa"
        ]);

        $doa->update(["nama" => $r->nama]);
    out:
        return redirect(route("data_ref.doa.index"))->with('success', 'Berhasil mengubah data ref doa!');
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
        $doa = Doa::find($id);
        if (!$doa) {
            abort(404);
            return;
        }
        $doa->delete();
        return redirect(route("data_ref.doa.index"))->with('success', 'Berhasil menghapus data ref doa!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ref\Hadits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RefHaditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hadits = Hadits::orderBy("nama", "asc")->get();
        return view("data_ref.hadits.index", compact("hadits"));
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
            "nama" => "required|unique:hadits"
        ]);

        Hadits::create(["nama" => $r->nama]);
        return redirect()->back()->with('success', 'Berhasil menambahkan data ref hadits!');
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
        $hadits = Hadits::find($id);
        if (!$hadits) {
            abort(404);
            return;
        }
        return view("data_ref.hadits.edit", compact("hadits"));
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
        $hadits = Hadits::find($id);
        if (!$hadits) {
            abort(404);
            return;
        }

        if (!($r->nama ?? NULL)) {
            abort(404);
            return;
        }

        if ($r->nama == $hadits->nama) {
            goto out;
        }

        $r->validate([
            "nama" => "required|unique:hadits"
        ]);

        $hadits->update(["nama" => $r->nama]);
    out:
        return redirect(route("data_ref.hadits.index"))->with('success', 'Berhasil mengubah data ref hadits!');
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
        $hadits = Hadits::find($id);
        if (!$hadits) {
            abort(404);
            return;
        }
        $hadits->delete();
        return redirect(route("data_ref.hadits.index"))->with('success', 'Berhasil menghapus data ref hadits!');
    }
}

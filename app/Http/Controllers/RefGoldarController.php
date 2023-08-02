<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Ref\Goldar;

class RefGoldarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goldar = Goldar::orderBy("nama", "asc")->get();
        return view("data_ref.goldar.index", compact("goldar"));
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
            "nama" => "required|unique:goldar"
        ]);

        Goldar::create(["nama" => $r->nama]);
        return redirect()->back()->with('success', 'Berhasil menambahkan data ref goldar!');
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
        $goldar = Goldar::find($id);
        if (!$goldar) {
            abort(404);
            return;
        }
        return view("data_ref.goldar.edit", compact("goldar"));
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
        $goldar = Goldar::find($id);
        if (!$goldar) {
            abort(404);
            return;
        }

        if (!($r->nama ?? NULL)) {
            abort(404);
            return;
        }

        if ($r->nama == $goldar->nama) {
            goto out;
        }

        $r->validate([
            "nama" => "required|unique:goldar"
        ]);

        $goldar->update(["nama" => $r->nama]);
    out:
        return redirect(route("data_ref.goldar.index"))->with('success', 'Berhasil mengubah data ref goldar!');
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
        $goldar = Goldar::find($id);
        if (!$goldar) {
            abort(404);
            return;
        }
        $goldar->delete();
        return redirect(route("data_ref.goldar.index"))->with('success', 'Berhasil menghapus data ref goldar!');
    }
}

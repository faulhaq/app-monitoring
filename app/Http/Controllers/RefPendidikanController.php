<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Ref\Pendidikan;

class RefPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendidikan = Pendidikan::orderBy("nama", "asc")->get();
        return view("data_ref.pendidikan.index", compact("pendidikan"));
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
            "nama" => "required|unique:pendidikan"
        ]);

        Pendidikan::create(["nama" => $r->nama]);
        return redirect()->back()->with('success', 'Berhasil menambahkan data ref pendidikan!');
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
        $pendidikan = Pendidikan::find($id);
        if (!$pendidikan) {
            abort(404);
            return;
        }
        return view("data_ref.pendidikan.edit", compact("pendidikan"));
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
        $pendidikan = Pendidikan::find($id);
        if (!$pendidikan) {
            abort(404);
            return;
        }

        if (!($r->nama ?? NULL)) {
            abort(404);
            return;
        }

        if ($r->nama == $pendidikan->nama) {
            goto out;
        }

        $r->validate([
            "nama" => "required|unique:pendidikan"
        ]);

        $pendidikan->update(["nama" => $r->nama]);
    out:
        return redirect(route("data_ref.pendidikan.index"))->with('success', 'Berhasil mengubah data ref pendidikan!');
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
        $pendidikan = Pendidikan::find($id);
        if (!$pendidikan) {
            abort(404);
            return;
        }
        $pendidikan->delete();
        return redirect(route("data_ref.pendidikan.index"))->with('success', 'Berhasil menghapus data ref pendidikan!');
    }
}

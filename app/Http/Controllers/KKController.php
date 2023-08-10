<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Master\KK;

class KKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kk = KK::get();
        return view("master_data.kk.index", compact("kk"));
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
            "no_kk" => "required|unique:kk|min:16|max:16"
        ]);
        KK::create(["no_kk" => $r->no_kk]);
        return redirect()->route('kk.index')->with('success', 'Data KK berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_kk = Crypt::decrypt($id);
        $kk = KK::find($id_kk);
        if (!$kk) {
            abort(404);
            return;
        }
        return view("master_data.kk.show", compact("kk"));
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
        $id_kk = Crypt::decrypt($id);
        $kk = KK::find($id_kk);
        if (!$kk) {
            abort(404);
            return;
        }
        $kk->delete();
        return redirect()->route('kk.index')->with('success', 'Data KK berhasil dihapus!');
    }
}

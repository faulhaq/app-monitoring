<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Guru;
use App\Siswa;
use Illuminate\Http\Request;
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
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $guru = Guru::OrderBy('nama', 'asc')->get();
        return view('admin.kelas.index', compact('kelas', 'guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Guru::OrderBy('nama', 'asc')->get();
        return view('admin.kelas.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id != '') {
            $this->validate($request, [
                'nama_kelas' => 'required',
                'id_guru' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'nama_kelas' => 'required',
                'id_guru' => 'required',
            ]);
        }
        // dd($request->id_guru);
        Kelas::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama_kelas' => $request->nama_kelas,
                'id_guru' => $request->id_guru,
            ]
        );

        return redirect()->back()->with('success', 'Data kelas berhasil diperbarui!');
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
        $kelas = Kelas::findorfail($id);
        $countSiswa = Siswa::where('id_kelas', $kelas->id)->count();
        if ($countSiswa >= 1) {
            Siswa::where('id_kelas', $kelas->id)->delete();
        } else {
        }
        $kelas->delete();
        return redirect()->back()->with('warning', 'Data kelas berhasil dihapus!');
    }

    public function getEdit(Request $request)
    {
        $kelas = Kelas::where('id', $request->id)->get();
        foreach ($kelas as $val) {
            $newForm[] = array(
                'id' => $val->id,
                'nama' => $val->nama_kelas,
                'id_guru' => $val->id_guru,
            );
        }
        return response()->json($newForm);
    }
}

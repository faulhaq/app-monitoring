<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Siswa;
use App\Models\Master\Kelas;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::get();
        $kelas = Kelas::get_kelas_aktif();
        return view("master_data.siswa.index", compact("siswa", "kelas"));
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

    public function validate_form_siswa(Request $r, bool $must_be_unique = true)
    {
        $uq = ($must_be_unique ? "|unique:siswa" : "");
        $r->validate([
            'nik'           => 'required|digits:16|'.$uq,
            'nis'           => 'required'.$uq,
            'nama'          => 'required|max:255',
            'jk'            => 'required|in:L,P',
            'agama'         => 'required',
            'tmp_lahir'     => 'required',
            'alamat'        => 'required',
            'tgl_lahir'     => 'required',
            'kelas'         => 'required',
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $this->validate_form_siswa($r);
        Siswa::create_and_add_kelas([
            'nik'           => $r->nik,
            'nis'           => $r->nis,
            'nama'          => $r->nama,
            'jk'            => $r->jk,
            'agama'         => $r->agama,
            'tmp_lahir'     => $r->tmp_lahir,
            'alamat'        => $r->alamat,
            'tgl_lahir'     => $r->tgl_lahir,
            'telp'          => $r->telp ?? NULL,
            'pekerjaan'     => $r->pekerjaan ?? NULL,
            'goldar'        => $r->goldar ?? NULL,
            'id_kelas'      => $r->kelas,
        ]);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
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
        $siswa = Siswa::find($id);
        if (!$siswa) {
            abort(404);
            return;
        }

        $kelas = Kelas::get_kelas_aktif();
        return view("master_data.siswa.edit", compact("siswa", "kelas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::find($id);
        if (!$siswa) {
            abort(404);
            return;
        }

        $this->validate_form_siswa($r, false);
        $siswa->update_data_dan_kelas([
            'nik'           => $r->nik,
            'nis'           => $r->nis,
            'nama'          => $r->nama,
            'jk'            => $r->jk,
            'agama'         => $r->agama,
            'tmp_lahir'     => $r->tmp_lahir,
            'alamat'        => $r->alamat,
            'tgl_lahir'     => $r->tgl_lahir,
            'telp'          => $r->telp ?? NULL,
            'pekerjaan'     => $r->pekerjaan ?? NULL,
            'goldar'        => $r->goldar ?? NULL,
            'id_kelas'      => $r->kelas,
        ]);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diubah!');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Master\Guru;
use App\User;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::orderBy("nama", "asc")->get();
        return view("master_data.guru.index", compact("guru"));
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

    public function validate_form_guru(Request $r, bool $must_be_unique = true)
    {
        $uq = ($must_be_unique ? "|unique:guru" : "");
        $r->validate([
            'nik'           => 'required|digits:16'.$uq,
            'nip'           => 'required|max:30'.$uq,
            'nama'          => 'required|max:255',
            'email'         => 'required|max:255|'.$uq,
            'jk'            => 'required|in:L,P',
            'agama'         => 'required',
            'tmp_lahir'     => 'required',
            'alamat'        => 'required',
            'telp'          => 'required',
            'tgl_lahir'     => 'required',
            'pendidikan'    => 'required',
            'goldar'        => 'required',
            'pekerjaan'     => 'required'
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
        $this->validate_form_guru($r);

        if ($r->foto) {
            $foto = $r->foto;
            $file_foto = date("Y_m_d__H_i_s") . "_" . $foto->getClientOriginalName();
            $foto->move("uploads/guru/", $file_foto);
        } else {
            $file_foto = NULL;
        }

        Guru::create([
            'nik'        => $r->nik,
            'nip'        => $r->nip,
            'nama'       => $r->nama,
            'email'      => $r->email,
            'jk'         => $r->jk,
            'agama'      => $r->agama,
            'tmp_lahir'  => $r->tmp_lahir,
            'alamat'     => $r->alamat,
            'telp'       => $r->telp,
            'tgl_lahir'  => $r->tgl_lahir,
            'pendidikan' => $r->pendidikan,
            'goldar'     => $r->goldar,
            'pekerjaan'  => $r->pekerjaan,
            'foto'       => $file_foto
        ]);
        return redirect()->back()->with('success', 'Berhasil menambahkan data guru baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::find($id);
        if (!$guru) {
            abort(404);
            return;
        }

        return view("master_data.guru.show", compact("guru"));
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
        $guru = Guru::find($id);
        if (!$guru) {
            abort(404);
            return;
        }

        return view("master_data.guru.edit", compact("guru"));
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
        $this->validate_form_guru($r, false);
        $id = Crypt::decrypt($id);
        $guru = Guru::find($id);
        if (!$guru) {
            return redirect()->back()->with('warning', 'Gagal mengubah data guru!');
        }

        $data = [
            'nik'        => $r->nik,
            'nip'        => $r->nip,
            'nama'       => $r->nama,
            'email'      => $r->email,
            'jk'         => $r->jk,
            'agama'      => $r->agama,
            'tmp_lahir'  => $r->tmp_lahir,
            'alamat'     => $r->alamat,
            'telp'       => $r->telp,
            'tgl_lahir'  => $r->tgl_lahir,
            'pendidikan' => $r->pendidikan,
            'goldar'     => $r->goldar,
            'pekerjaan'  => $r->pekerjaan,
        ];

        if ($r->foto) {
            $foto = $r->foto;
            $file_foto = date("Y_m_d__H_i_s") . "_" . $foto->getClientOriginalName();
            $foto->move("uploads/guru/", $file_foto);
            $data["foto"] = $file_foto;
        }

        $guru->update($data);
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diubah!');
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
        $guru = Guru::find($id);
        if (!$guru) {
            return redirect()->back()->with('warning', 'Gagal menghapus data guru!');
        }

        $user = User::where("id_guru", $guru->id);
        if ($user) {
            $user->delete();
        }

        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
    }

    public function get_list()
    {
        $guru = Guru::select(["guru.id", "guru.nik", "guru.nama", "guru.email"])
                ->leftJoin("users", "guru.id", "users.id_guru")
                ->whereNull("users.id_guru")
                ->get();
        return response()->json([
            "data" => $guru
        ]);
    }

    public function update_foto($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::find($id);
        if (!$guru) {
            abort(404);
            return;
        }
        return view('master_data.guru.update_foto', compact('guru'));
    }

    public function simpan_foto(Request $r, $id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::find($id);
        if (!$guru) {
            abort(404);
            return;
        }

        $foto = $r->foto;
        $file_foto = date("Y_m_d__H_i_s") . "_" . $foto->getClientOriginalName();
        $foto->move("uploads/guru/", $file_foto);
        $guru->update(["foto" => $file_foto]);
        return redirect()->route('guru.index')->with('success', 'Foto berhasil diupdate!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Master\OrangTua;
use App\Models\Master\KK;
use App\Models\Master\Siswa;
use App\User;

class OrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::get();
        $kk = KK::get();
        return view("master_data.orang_tua.index", compact("kk", "siswa"));
    }

    public function list_orang_tua($id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        if (!$id_siswa) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id_siswa);
        if (!$siswa) {
            abort(404);
            return;
        }

        $id_kk = $siswa->id_kk;
        $orang_tua = OrangTua::where("id_kk", $id_kk)->get();
        $kk = KK::get();
        return view("master_data.orang_tua.list_orang_tua",
                    compact("kk", "siswa", "orang_tua"));
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

    public function validate_form_orang_tua(Request $r, bool $must_be_unique = true)
    {
        $uq = ($must_be_unique ? "|unique:orang_tua" : "");
        $r->validate([
            'no_kk'         => 'required|digits:16',
            'nik'           => 'required|digits:16'.$uq,
            'nama'          => 'required|max:255',
            'email'         => 'required|max:255'.$uq,
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
        $this->validate_form_orang_tua($r);

        $id_kk = KK::where("no_kk", $r->no_kk)->first();
        if (!$id_kk) {
            abort(404);
            return;
        }
        $id_kk = $id_kk->id;

        if ($r->foto) {
            $foto = $r->foto;
            $file_foto = date("Y_m_d__H_i_s") . "_" . $foto->getClientOriginalName();
            $foto->move("uploads/orang_tua/", $file_foto);
        } else {
            $file_foto = NULL;
        }

        OrangTua::create([
            'id_kk'      => $id_kk,
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
        return redirect()->back()->with('success', 'Berhasil menambahkan data orang_tua baru!');
    }

    private function decrypt_id($id)
    {
        $id = Crypt::decrypt($id);
        if (!$id) {
            return NULL;
        }

        $id = json_decode($id, true);
        if (!$id) {
            return NULL;
        }

        if (!isset($id["id_orang_tua"], $id["id_siswa"])) {
            return NULL;
        }

        if (!is_integer($id["id_orang_tua"]) || !is_integer($id["id_siswa"])) {
            return NULL;
        }
        return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $this->decrypt_id($id);
        if (!$id) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id["id_siswa"]);
        if (!$siswa) {
            abort(404);
            return;
        }

        $orang_tua = OrangTua::find($id["id_orang_tua"]);
        if (!$orang_tua) {
            abort(404);
            return;
        }
        return view("master_data.orang_tua.show", compact("orang_tua", "id", "siswa"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = $this->decrypt_id($id);
        if (!$id) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id["id_siswa"]);
        if (!$siswa) {
            abort(404);
            return;
        }

        $orang_tua = OrangTua::find($id["id_orang_tua"]);
        if (!$orang_tua) {
            abort(404);
            return;
        }
        return view("master_data.orang_tua.edit", compact("orang_tua", "siswa", "id"));
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
        $this->validate_form_orang_tua($r, false);
        $id = $this->decrypt_id($id);
        if (!$id) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id["id_siswa"]);
        if (!$siswa) {
            abort(404);
            return;
        }

        $orang_tua = OrangTua::find($id["id_orang_tua"]);
        if (!$orang_tua) {
            abort(404);
            return;
        }

        $id_kk = KK::where("no_kk", $r->no_kk)->first();
        if (!$id_kk) {
            abort(404);
            return;
        }
        $id_kk = $id_kk->id;

        $data = [
            'id_kk'      => $id_kk,
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
            $foto->move("uploads/orang_tua/", $file_foto);
            $data["foto"] = $file_foto;
        }

        $orang_tua->update($data);
        $enc_id_siswa = Crypt::encrypt($id["id_siswa"]);
        return redirect()->route('orang_tua.list_orang_tua', $enc_id_siswa)->with('success', 'Data orang tua berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = $this->decrypt_id($id);
        if (!$id) {
            abort(404);
            return;
        }

        $siswa = Siswa::find($id["id_siswa"]);
        if (!$siswa) {
            abort(404);
            return;
        }

        $orang_tua = OrangTua::find($id["id_orang_tua"]);
        if (!$orang_tua) {
            abort(404);
            return;
        }

        $user = User::where("id_orang_tua", $orang_tua->id);
        if ($user) {
            $user->delete();
        }

        $orang_tua->delete();
        return redirect()->route('orang_tua.index')->with('success', 'Data orang tua berhasil dihapus!');
    }

    public function get_list()
    {
        $orang_tua = OrangTua::select(["orang_tua.id", "orang_tua.nik", "orang_tua.nama", "orang_tua.email"])
                        ->leftJoin("users", "orang_tua.id", "users.id_orang_tua")
                        ->whereNull("users.id_orang_tua")
                        ->get();
        return response()->json([
            "data" => $orang_tua
        ]);
    }

    public function update_foto($id)
    {
        $id = Crypt::decrypt($id);
        $orang_tua = OrangTua::find($id);
        if (!$orang_tua) {
            abort(404);
            return;
        }
        return view('master_data.orang_tua.update_foto', compact('orang_tua'));
    }

    public function simpan_foto(Request $r, $id)
    {
        $id = Crypt::decrypt($id);
        $orang_tua = OrangTua::find($id);
        if (!$orang_tua) {
            abort(404);
            return;
        }

        $foto = $r->foto;
        $file_foto = date("Y_m_d__H_i_s") . "_" . $foto->getClientOriginalName();
        $foto->move("uploads/orang_tua/", $file_foto);
        $orang_tua->update(["foto" => $file_foto]);
        return redirect()->route('orang_tua.index')->with('success', 'Foto berhasil diupdate!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\KK;
use App\Models\Master\Siswa;
use App\Models\Master\Kelas;
use App\Models\Master\TahunAjaran;
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
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $fstatus = is_string($_GET["fstatus"] ?? NULL) ? $_GET["fstatus"] : NULL;

        $kelas = Kelas::get();
        $tahun_ajaran = TahunAjaran::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();

        $siswa = Siswa::select("siswa.*");
        if ($fkelas && $fkelas !== "all") {
            $siswa = $siswa->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                        ->where("kelas_siswa.id_kelas", $fkelas);
        }
        if ($fstatus && $fstatus !== "all") {
            $siswa = $siswa->where("status", $fstatus);
        }
        $siswa = $siswa->orderBy("nama", "asc")->get();
        $kk = KK::get();
        return view("master_data.siswa.index",
                    compact("kk", "siswa", "kelas", "tahun_ajaran", "fkelas",
                            "fstatus", "ftahun_ajaran", "id_tahun_ajaran_aktif"));
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
            'no_kk'         => 'required|digits:16',
            'nik'           => 'required|digits:16|'.$uq,
            'nis'           => 'required'.$uq,
            'nama'          => 'required|max:255',
            'jk'            => 'required|in:L,P',
            'agama'         => 'required',
            'tmp_lahir'     => 'required',
            'alamat'        => 'required',
            'tgl_lahir'     => 'required',
            'status'        => 'required|in:non-aktif,aktif,lulus,pindah',
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

        $kk = KK::where("no_kk", $r->no_kk)->first();
        if (!$kk) {
            $kk = KK::create([
                "no_kk" => $r->no_kk
            ]);
        }
        $id_kk = $kk->id;

        if ($r->foto) {
            $foto = $r->foto;
            $file_foto = date("Y_m_d__H_i_s") . "_" . $foto->getClientOriginalName();
            $foto->move("uploads/siswa/", $file_foto);
        } else {
            $file_foto = NULL;
        }

        Siswa::create([
            'id_kk'         => $id_kk,
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
            'foto'          => $file_foto,
            'status'        => $r->status
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
        $id = Crypt::decrypt($id);
        $siswa = Siswa::find($id);
        if (!$siswa) {
            abort(404);
            return;
        }

        return view("master_data.siswa.show", compact("siswa"));
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

        $id_kk = KK::where("no_kk", $r->no_kk)->first();
        if (!$id_kk) {
            abort(404);
            return;
        }
        $id_kk = $id_kk->id;

        $this->validate_form_siswa($r, false);

        if ($r->foto) {
            $foto = $r->foto;
            $file_foto = date("Y_m_d__H_i_s") . "_" . $foto->getClientOriginalName();
            $foto->move("uploads/siswa/", $file_foto);
        } else {
            $file_foto = NULL;
        }

        $siswa->update([
            'id_kk'         => $id_kk,
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
            'foto'          => $file_foto,
            'status'        => $r->status
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
        $id = Crypt::decrypt($id);
        $siswa = Siswa::find($id);
        if (!$siswa) {
            abort(404);
            return;
        }
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }

    public function update_foto($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::find($id);
        if (!$siswa) {
            abort(404);
            return;
        }
        return view('master_data.siswa.update_foto', compact('siswa'));
    }

    public function simpan_foto(Request $r, $id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::find($id);
        if (!$siswa) {
            abort(404);
            return;
        }

        $foto = $r->foto;
        $file_foto = date("Y_m_d__H_i_s") . "_" . $foto->getClientOriginalName();
        $foto->move("uploads/siswa/", $file_foto);
        $siswa->update(["foto" => $file_foto]);
        return redirect()->route('siswa.index')->with('success', 'Foto berhasil diupdate!');
    }

    public static function status_drop_down($selected = null)
    {
        $r = "";
        $status = ['non-aktif', 'aktif', 'lulus', 'pindah'];
        foreach ($status as $v) {
            if ($v === $selected) {
                $sel = " selected";
            } else {
                $sel = "";
            }
            $r .= "<option value=\"".e($v)."\"{$sel}>".e(ucwords($v))."</option>";
        }
        return $r;
    }

    public function get_siswa_no_kelas($id_kelas)
    {
        $id_kelas = Crypt::decrypt($id_kelas);
        $siswa = Siswa::get_siswa_no_kelas($id_kelas);
        return response()->json($siswa);
    }
}

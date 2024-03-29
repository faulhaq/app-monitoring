<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Kelas;
use App\Models\Master\TahunAjaran;
use App\Models\Master\Guru;
use App\Models\Master\Siswa;
use App\Models\KelasSiswa;
use Illuminate\Support\Facades\Crypt;
use Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::get();
        $guru = Guru::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        $ftahun_ajaran = is_string($_GET["ftahun_ajaran"] ?? NULL) ? $_GET["ftahun_ajaran"] : NULL;

        if ($ftahun_ajaran && $ftahun_ajaran !== "all") {
            $kelas = Kelas::where("id_tahun_ajaran", $ftahun_ajaran)->orderBy("tingkatan", "asc")->get();
        } else {
            $kelas = Kelas::orderBy("tingkatan", "asc")->get();
        }

        return view("master_data.kelas.index",
                    compact("kelas", "tahun_ajaran", "guru", "ftahun_ajaran",
                            "id_tahun_ajaran_aktif"));
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
        $user = Auth::user();
        if ($user->role !== "admin") {
            abort(404);
            return;
        }

        $r->validate([
            "tingkatan"     => "required",
            "tahun_ajaran"  => "required",
            "wali_kelas"    => "required"
        ]);

        Kelas::create([
            "tingkatan"        => $r->tingkatan,
            "nama"             => $r->nama,
            "id_tahun_ajaran"  => $r->tahun_ajaran,
            "id_guru"          => $r->wali_kelas
        ]);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
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
        return;
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
        $kelas = Kelas::find($id);
        if (!$kelas) {
            abort(404);
            return;
        }

        $user = Auth::user();
        if ($user->role === "guru") {
            if ($kelas->id_guru !== $user->id_guru) {
                abort(404);
                return;
            }
        }

        $tahun_ajaran = TahunAjaran::get();
        $guru = Guru::get();
        return view("master_data.kelas.edit", compact("kelas", "tahun_ajaran", "guru"));
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
        $user = Auth::user();
        if ($user->role !== "admin") {
            abort(404);
            return;
        }

        $r->validate([
            "tingkatan"     => "required",
            "wali_kelas"    => "required"
        ]);

        $id = Crypt::decrypt($id);
        $kelas = Kelas::find($id);
        if (!$kelas) {
            abort(404);
            return;
        }

        // dd($r->toArray());
        $kelas->update([
            "tingkatan"        => $r->tingkatan,
            "nama"             => $r->nama,
            "id_guru"          => $r->wali_kelas
        ]);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role !== "admin") {
            abort(404);
            return;
        }

        $id_kelas = Crypt::decrypt($id);
        $kelas = Kelas::find($id_kelas);
        if (!$kelas) {
            abort(404);
            return;
        }
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus!');
    }

    public function kelola($id)
    {
        $enc_id_kelas = $id;
        $id = Crypt::decrypt($id);
        $kelas = Kelas::find($id);
        if (!$kelas) {
            abort(404);
            return;
        }

        $siswa = Siswa::get_siswa_by_id_kelas($id)->get();
        return view("master_data.kelas.kelola", compact("kelas", "siswa", "enc_id_kelas"));
    }

    public function hapus_siswa($id_kelas, $id_siswa)
    {
        $enc_id_kelas = $id_kelas;
        $id_kelas = Crypt::decrypt($id_kelas);
        $id_siswa = Crypt::decrypt($id_siswa);

        $kelas = Kelas::find($id_kelas);
        if (!$kelas) {
            abort(404);
            return;
        }

        $user = Auth::user();
        if ($user->role !== "admin") {
            abort(404);
            return;
        }
    
        $siswa = Siswa::get_siswa_by_id_kelas($kelas->id)
                 ->where("siswa.id", $id_siswa)
                 ->first();
        if (!$siswa) {
            abort(404);
            return;
        }

        $kelas_siswa = KelasSiswa::find($siswa->id_kelas_siswa);
        if (!$kelas_siswa) {
            abort(404);
            return;
        }
        $kelas_siswa->delete();
        return redirect()->route('kelas.kelola', $enc_id_kelas)->with('success', 'Siswa berhasil dihapus dari kelas!');
    }

    public function kelola_tambah_siswa($id, Request $r)
    {
        $enc_id_kelas = $id;
        $id_kelas = Crypt::decrypt($id);

        $kelas = Kelas::find($id_kelas);
        if (!$kelas) {
            abort(404);
            return;
        }

        $user = Auth::user();
        if ($user->role !== "admin") {
            abort(404);
            return;
        }

        $data = [];
        foreach ($r->id_siswa as $id) {
            if (!$id)
                continue;
            $data[] = [
                "id_siswa" => $id,
                "id_kelas" => $id_kelas,
                "created_at" => date("Y-m-d H:i:s")
            ];
        }
        KelasSiswa::insert($data);
        return redirect()->route('kelas.kelola', $enc_id_kelas)->with('success', 'Siswa berhasil ditambahkan!');
    }
}

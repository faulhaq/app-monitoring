<?php

namespace App\Http\Controllers;

use Auth;
use App\Siswa;
use App\Kelas;
use App\User;
use App\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use PDF;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        return view('admin.siswa.index', compact('kelas'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required|string|unique:siswa',
            'nama' => 'required',
            'jk' => 'required',
            'id_kelas' => 'required',
            'agama' => 'required',
            'telp' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'goldar' => 'required',
            'alamat' => 'required'
        ]);

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
            Siswa::create([
                'nik' => $request->nik,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'id_kelas' => $request->id_kelas,
                'agama' => $request->agama,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'goldar' => $request->goldar,
                'alamat' => $request->alamat,
                'foto' => 'uploads/siswa/' . $new_foto
            ]);
            $foto->move('uploads/siswa/', $new_foto);
        } else {
            if ($request->jk == 'L') {
                $foto = 'uploads/siswa/52471919042020_male.jpg';
            } else {
                $foto = 'uploads/siswa/50271431012020_female.jpg';
            }
            Siswa::create([
                'nik' => $request->nik,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'id_kelas' => $request->id_kelas,
                'agama' => $request->agama,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'goldar' => $request->goldar,
                'alamat' => $request->alamat,
                'foto' => $foto
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan data siswa baru!');
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
        $siswa = Siswa::findorfail($id);
        return view('admin.siswa.details', compact('siswa'));
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
        $siswa = Siswa::findorfail($id);
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
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
        $this->validate($request, [
            'nik' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'id_kelas' => 'required',
            'agama' => 'required',
            'telp' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'goldar' => 'required',
            'alamat' => 'required'
        ]);

        $siswa = Siswa::findorfail($id);
        $siswa_data = [
            'nik' => $request->nik,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'id_kelas' => $request->id_kelas,
            'agama' => $request->agama,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'goldar' => $request->goldar,
            'alamat' => $request->alamat
        ];
        $siswa->update($siswa_data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findorfail($id);
        if (!$siswa) {
            return redirect()->back()->with('warning', 'Data siswa gagal dihapus!');
        }
        $siswa->delete();
        return redirect()->back()->with('warning', 'Data siswa berhasil dihapus!');
    }
    public function ubah_foto($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findorfail($id);
        return view('admin.siswa.ubah-foto', compact('siswa'));
    }

    public function update_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'required'
        ]);

        $siswa = Siswa::findorfail($id);
        $foto = $request->foto;
        $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
        $siswa_data = [
            'foto' => 'uploads/siswa/' . $new_foto,
        ];
        $foto->move('uploads/siswa/', $new_foto);
        $siswa->update($siswa_data);

        return redirect()->route('siswa.index')->with('success', 'Berhasil merubah foto!');
    }

    public function view(Request $request)
    {
        $siswa = Siswa::OrderBy('nama', 'asc')->where('id_kelas', $request->id)->get();
        $newForm = [];
        foreach ($siswa as $val) {
            $newForm[] = array(
                'kelas' => $val->kelas->nama_kelas,
                'nik' => $val->nik,
                'nama' => $val->nama,
                'jk' => $val->jk,
                'foto' => $val->foto
            );
        }

        return response()->json($newForm);
    }

    public function cetak_pdf(Request $request)
    {
        $siswa = siswa::OrderBy('nama', 'asc')->where('id_kelas', $request->id)->get();
        $kelas = Kelas::findorfail($request->id);

        $pdf = PDF::loadView('siswa-pdf', ['siswa' => $siswa, 'kelas' => $kelas]);
        return $pdf->stream();
        // return $pdf->stream('jadwal-pdf.pdf');
    }

    public function kelas($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::where('id_kelas', $id)->OrderBy('nama', 'asc')->get();
        $kelas = Kelas::findorfail($id);
        return view('admin.siswa.show', compact('siswa', 'kelas'));
    }

    public function show_anak()
    {
        $id_orang_tua = Auth::user()->id_orang_tua;
        $siswa = OrangTua::get_list_anak($id_orang_tua);
        return view('admin.siswa.show', compact('siswa'));
    }

    public function export_excel()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_siswa', $nama_file);
        Excel::import(new SiswaImport, public_path('/file_siswa/' . $nama_file));
        return redirect()->back()->with('success', 'Data Siswa Berhasil Diimport!');
    }

}

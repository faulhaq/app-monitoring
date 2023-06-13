<?php

namespace App\Http\Controllers;

use Auth;
use App\OrangTua;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use PDF;
use App\Exports\OrangTuaExport;
use App\Imports\OrangTuaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class OrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.orang_tua.index', [
            "orang_tua" => OrangTua::get()
        ]);
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
            'nik' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'telp' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'goldar' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
        ]);

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
            OrangTua::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'agama' => $request->agama,
                'pendidikan' => $request->pendidikan,
                'goldar' => $request->goldar,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat, 
                'foto' => 'uploads/orang_tua/' . $new_foto
            ]);
            $foto->move('uploads/orang_tua/', $new_foto);
        } else {
            if ($request->jk == 'L') {
                $foto = 'uploads/orang_tua/52471919042020_male.jpg';
            } else {
                $foto = 'uploads/orang_tua/50271431012020_female.jpg';
            }
            OrangTua::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'agama' => $request->agama,
                'pendidikan' => $request->pendidikan,
                'goldar' => $request->goldar,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat, 
                'foto' => $foto
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan data orang tua baru!');
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
        $orang_tua = OrangTua::findorfail($id);
        return view('admin.orang_tua.details', compact('orang_tua'));
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
        $orang_tua = OrangTua::findorfail($id);
        return view('admin.orang_tua.edit');
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
            'nama' => 'required',
            'jk' => 'required',
        ]);

        $orang_tua = OrangTua::findorfail($id);
        $user = User::where('id_orang_tua', $orang_tua->id)->first();
        if ($user) {
            $user_data = [
                'name' => $request->nama
            ];
            $user->update($user_data);
        } else {
        }
        $orang_tua_data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
        ];
        $orang_tua->update($orang_tua_data);

        return redirect()->route('orang_tua.index')->with('success', 'Data orang tua berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $orang_tua = OrangTua::findorfail($id);
        $countUser = User::where('id_orang_tua', $orang_tua->id)->count();
        if ($countUser >= 1) {
            $user = User::where('id_orang_tua', $orang_tua->id)->first();
            $orang_tua->delete();
            $user->delete();
            return redirect()->back()->with('warning', 'Data orang tua berhasil dihapus! (Silahkan cek trash data orang tua)');
        } else {
            $orang_tua->delete();
            return redirect()->back()->with('warning', 'Data orang tua berhasil dihapus! (Silahkan cek trash data orang tua)');
        }
    }

    public function trash()
    {
        $orang_tua = OrangTua::onlyTrashed()->get();
        return view('admin.orang_tua.trash', compact('orang_tua'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $orang_tua = OrangTua::withTrashed()->findorfail($id);
        $countUser = User::withTrashed()->where('id_orang_tua', $orang_tua->id)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('id_orang_tua', $orang_tua->id)->first();
            $orang_tua->restore();
            $user->restore();
            return redirect()->back()->with('info', 'Data orang tua berhasil direstore! (Silahkan cek data orang tua)');
        } else {
            $orang_tua->restore();
            return redirect()->back()->with('info', 'Data orang tua berhasil direstore! (Silahkan cek data orang tua)');
        }
    }

    public function kill($id)
    {
        $orang_tua = OrangTua::withTrashed()->findorfail($id);
        $countUser = User::withTrashed()->where('id_orang_tua', $orang_tua->id)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('id_orang_tua', $orang_tua->id)->first();
            $orang_tua->forceDelete();
            $user->forceDelete();
            return redirect()->back()->with('success', 'Data orang tua berhasil dihapus secara permanent');
        } else {
            $orang_tua->forceDelete();
            return redirect()->back()->with('success', 'Data orang tua berhasil dihapus secara permanent');
        }
    }

    public function ubah_foto($id)
    {
        $id = Crypt::decrypt($id);
        $orang_tua = OrangTua::findorfail($id);
        return view('admin.orang_tua.ubah-foto', compact('orang_tua'));
    }

    public function update_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'required'
        ]);

        $orang_tua = OrangTua::findorfail($id);
        $foto = $request->foto;
        $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
        $orang_tua_data = [
            'foto' => 'uploads/orang_tua/' . $new_foto,
        ];
        $foto->move('uploads/orang_tua/', $new_foto);
        $orang_tua->update($orang_tua_data);

        return redirect()->route('orang_tua.index')->with('success', 'Berhasil merubah foto!');
    }

    public function view(Request $request)
    {
        $orang_tua = OrangTua::OrderBy('nama', 'asc')->get();
        $newForm = [];
        foreach ($orang_tua as $val) {
            $newForm[] = array(
                'id_orang_tua' => $val->no_induk,
                'nama' => $val->nama,
                'jk' => $val->jk,
                'foto' => $val->foto
            );
        }

        return response()->json($newForm);
    }

    public function cetak_pdf(Request $request)
    {
        $orang_tua = orang_tua::OrderBy('nama', 'asc')->get();

        $pdf = PDF::loadView('orang_tua-pdf', ['orang_tua' => $orang_tua]);
        return $pdf->stream();
        // return $pdf->stream('jadwal-pdf.pdf');
    }


    public function export_excel()
    {
        return Excel::download(new OrangTuaExport, 'orang_tua.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_orang_tua', $nama_file);
        Excel::import(new OrangTuaImport, public_path('/file_orang_tua/' . $nama_file));
        return redirect()->back()->with('success', 'Data OrangTua Berhasil Diimport!');
    }

    public function deleteAll()
    {
        $orang_tua = OrangTua::all();
        if ($orang_tua->count() >= 1) {
            OrangTua::whereNotNull('id')->delete();
            OrangTua::withTrashed()->whereNotNull('id')->forceDelete();
            return redirect()->back()->with('success', 'Data table orang tua berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data table orang tua kosong!');
        }
    }
}

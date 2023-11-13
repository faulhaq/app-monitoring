<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\User;
use App\Models\Master\OrangTua;
use App\Models\Master\Guru;

function rstr(int $len)
{
    $r = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM!@#$%^&*()";
    $ret = "";
    $clq = strlen($r);
    for ($i = 0; $i < $len; $i++)
        $ret .= $r[rand(0, $clq - 1)];

    return $ret;
}

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $gen_pass = rstr(12);
        return view("master_data.user.index", compact("user", "gen_pass"));
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
            "role"       => "required|in:admin,guru,orang_tua",
            "password"   => "required|min:8",
        ]);

        if ($r->role === "orang_tua") {
            $r->validate(["id_fk_user" => "required"]);
            return $this->store_orang_tua($r);
        } else if ($r->role === "guru") {
            $r->validate(["id_fk_user" => "required"]);
            return $this->store_guru($r);
        } else if ($r->role === "admin") {
            $r->validate(["email" => "required"]);
            return $this->store_admin($r);
        } else {
            abort(404);
        }
    }

    public function store_admin(Request $r)
    {
        User::create([
            "role"     => "admin",
            "email"    => $r->email,
            "password" => password_hash($r->password, PASSWORD_BCRYPT)
        ]);
        return redirect()->back()->with("success", "Berhasil membuat user admin!");
    }

    public function store_orang_tua(Request $r)
    {
        $orang_tua = OrangTua::find($r->id_fk_user);
        if (!$orang_tua) {
            return redirect()->back()->with('warning', 'Orang tua tidak ditemukan');
        }

        User::create([
            "role"         => "orang_tua",
            "email"        => $orang_tua->email,
            "password"     => password_hash($r->password, PASSWORD_BCRYPT),
            "id_orang_tua" => $orang_tua->id
        ]);

        return redirect()->back()->with("success", "Berhasil membuat user orang tua!");
    }

    public function store_guru(Request $r)
    {
        $guru = Guru::find($r->id_fk_user);
        if (!$guru) {
            return redirect()->back()->with('warning', 'Guru tidak ditemukan');
        }

        User::create([
            "role"      => "guru",
            "email"     => $guru->email,
            "password"  => password_hash($r->password, PASSWORD_BCRYPT),
            "id_guru"   => $guru->id
        ]);

        return redirect()->back()->with("success", "Berhasil membuat user guru!");
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
        $user = User::find($id);
        if (!$user) {
            abort(404);
            return;
        }

        return view("master_data.user.show", compact("user"));
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
        $user = User::find($id);
        return view("master_data.user.edit", compact("user"));
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
        $r->validate([
            "password" => "required|min:8",
        ]);

        $id = Crypt::decrypt($id);
        $user = User::find($id);
        if (!$user) {
            abort(404);
            return;
        }

        $user->update([
            "password" => password_hash($r->password, PASSWORD_BCRYPT)
        ]);
        return redirect(route("user.index"))->with("success", "Berhasil mengubah data user!");
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
        $user = User::find($id);
        if (!$user || $id == 1) {
            abort(404);
            return;
        }
        $user->delete();
        return redirect()->back()->with("success", "Berhasil menghapus data user!");
    }

    public function profile()
    {
        return view('user.pengaturan');
    }

    public function ubah_profile(Request $request)
    {
        if ($request->role == 'Guru') {
            $this->validate($request, [
                'nama' => 'required',
                'jk' => 'required',
            ]);
            $guru = Guru::where('id_card', Auth::user()->id_card)->first();
            $user = User::where('id_card', Auth::user()->id_card)->first();
            dd($user);
            if ($user) {
                $user_data = [
                    'name' => $request->name
                ];
                $user->update($user_data);
            } else {
            }
            $guru_data = [
                'nama' => $request->name,
                'jk' => $request->jk,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir
            ];
            $guru->update($guru_data);
            return redirect()->route('profile')->with('success', 'Profile anda berhasil diperbarui!');
        } elseif ($request->role == 'Siswa') {
            $this->validate($request, [
                'nama' => 'required',
                'jk' => 'required',
                'id_kelas' => 'required'
            ]);
            $siswa = Siswa::where('no_induk', Auth::user()->no_induk)->first();
            $user = User::where('no_induk', Auth::user()->no_induk)->first();
            if ($user) {
                $user_data = [
                    'name' => $request->name
                ];
                $user->update($user_data);
            } else {
            }
            $siswa_data = [
                'nis' => $request->nis,
                'nama' => $request->name,
                'jk' => $request->jk,
                'id_kelas' => $request->id_kelas,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
            ];
            $siswa->update($siswa_data);
            return redirect()->route('profile')->with('success', 'Profile anda berhasil diperbarui!');
        } else {
            $user = User::findorfail(Auth::user()->id);
            $data_user = [
                'name' => $request->name,
            ];
            $user->update($data_user);
            return redirect()->route('profile')->with('success', 'Profile anda berhasil diperbarui!');
        }
    }

    public function edit_foto()
    {
        if (Auth::user()->role == 'Guru' || Auth::user()->role == 'Siswa') {
            return view('user.foto');
        } else {
            return redirect()->back()->with('error', 'Not Found 404!');
        }
    }

    public function ubah_foto(Request $request)
    {
        if ($request->role == 'Guru') {
            $this->validate($request, [
                'foto' => 'required'
            ]);
            $guru = Guru::where('id_card', Auth::user()->id_card)->first();
            $foto = $request->foto;
            $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
            $guru_data = [
                'foto' => 'uploads/guru/' . $new_foto,
            ];
            $foto->move('uploads/guru/', $new_foto);
            $guru->update($guru_data);
            return redirect()->route('profile')->with('success', 'Foto Profile anda berhasil diperbarui!');
        } else {
            $this->validate($request, [
                'foto' => 'required'
            ]);
            $siswa = Siswa::where('no_induk', Auth::user()->no_induk)->first();
            $foto = $request->foto;
            $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
            $siswa_data = [
                'foto' => 'uploads/siswa/' . $new_foto,
            ];
            $foto->move('uploads/siswa/', $new_foto);
            $siswa->update($siswa_data);
            return redirect()->route('profile')->with('success', 'Foto Profile anda berhasil diperbarui!!');
        }
    }

    public function edit_email()
    {
        return view('user.email');
    }

    public function ubah_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email'
        ]);
        $user = User::findorfail(Auth::user()->id);
        $cekUser = User::where('email', $request->email)->count();
        if ($cekUser >= 1) {
            return redirect()->back()->with('error', 'Maaf email ini sudah terdaftar!');
        } else {
            $user_email = [
                'email' => $request->email,
            ];
            $user->update($user_email);
            return redirect()->back()->with('success', 'Email anda berhasil diperbarui!');
        }
    }

    public function edit_password()
    {
        return view('user.password');
    }

    public function ubah_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::findorfail(Auth::user()->id);
        if ($request->password_lama) {
            if (Hash::check($request->password_lama, $user->password)) {
                if ($request->password_lama == $request->password) {
                    return redirect()->back()->with('error', 'Maaf password yang anda masukkan sama!');
                } else {
                    $user_password = [
                        'password' => Hash::make($request->password),
                    ];
                    $user->update($user_password);
                    return redirect()->back()->with('success', 'Password anda berhasil diperbarui!');
                }
            } else {
                return redirect()->back()->with('error', 'Tolong masukkan password lama anda dengan benar!');
            }
        } else {
            return redirect()->back()->with('error', 'Tolong masukkan password lama anda terlebih dahulu!');
        }
    }

    public function cek_email(Request $request)
    {
        $countUser = User::where('email', $request->email)->count();
        if ($countUser >= 1) {
            return response()->json(['success' => 'Email Anda Benar']);
        } else {
            return response()->json(['error' => 'Maaf user not found!']);
        }
    }

    public function cek_password(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $countUser = User::where('email', $request->email)->count();
        if ($countUser >= 1) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json(['success' => 'Password Anda Benar']);
            } else {
                return response()->json(['error' => 'Maaf user not found!']);
            }
        } else {
            return response()->json(['warning' => 'Maaf user not found!']);
        }
    }
}

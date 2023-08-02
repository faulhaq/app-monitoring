<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\User;
use App\Models\Master\OrangTua;
use App\Models\Master\Guru;

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
        return view("master_data.user.index", compact("user"));
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
        return redirect()->back()->with("success", "Berhasil mengubah data user!");
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

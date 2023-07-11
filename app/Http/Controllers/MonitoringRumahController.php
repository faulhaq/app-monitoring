<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\MonitoringRumah;
use Illuminate\Support\Facades\Crypt;

class MonitoringRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitoring = MonitoringRumah::get();
        return view('admin.monitoring_rumah.index', compact('monitoring'));
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
            'tipe' => 'required|in:yes_no,isian',
            'data' => 'required',
        ]);

        $data = [
            "q" => $request->data,
            "tipe" => $request->tipe  
        ];
        MonitoringRumah::create([
            "tipe" => $request->tipe,
            "data" => json_encode($data),
            "created_by" => Auth::user()->id_guru
        ]);

        return redirect()->back()->with('success', 'Data monitoring rumah berhasil ditambahkan!');
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
        $monitoring = MonitoringRumah::findorfail($id);
        return view('admin.monitoring_rumah.edit', compact('monitoring'));
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
            'tipe' => 'required|in:yes_no,isian',
            'data' => 'required',
        ]);

        $data = [
            "q" => $request->data,
            "tipe" => $request->tipe  
        ];

        $id = Crypt::decrypt($id);
        $monitoring = MonitoringRumah::findorfail($id);
        $monitoring->update([
            "tipe" => $request->tipe,
            "data" => json_encode($data)
        ]);
        return redirect()->route('monitoring_rumah.index')->with('success', 'Data monitoring rumah berhasil diperbarui!');
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
        $monitoring = MonitoringRumah::findorfail($id);
        $monitoring->delete();
        return redirect()->back()->with('warning', 'Data monitoring rumah berhasil dihapus!');
    }
}

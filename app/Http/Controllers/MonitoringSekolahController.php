<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Siswa;
use App\Models\Master\Kelas;
use App\Models\Master\TahunAjaran;

class MonitoringSekolahController extends Controller
{
    public function index()
    {
        return view("monitoring.sekolah.index");
    }

    public function tahsin()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.tahsin",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }

    public function tahfidz()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.tahfidz",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }

    public function mahfudhot()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.mahfudhot",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }

    public function hadits()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.hadits",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }

    public function doa()
    {
        $fkelas = is_string($_GET["fkelas"] ?? NULL) ? $_GET["fkelas"] : NULL;
        $kelas = Kelas::get();
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        return view("monitoring.sekolah.doa",
                    compact("kelas", "id_tahun_ajaran_aktif", "fkelas"));
    }


}




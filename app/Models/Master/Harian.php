<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Kelas;
use DB;
use PDO;

class Harian extends Model
{
    protected $fillable = ['bulan', 'tahun', 'id_kelas'];

    protected $table = 'data_harian';

    public $timestamps = true;

    public const MAX_YEAR = 2100;    

    public const LIST_BULAN = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, "id_kelas", "id");
    }

    public function bulan()
    {
        return self::LIST_BULAN[$this->bulan - 1];
    }

    public static function get_list_tahun_by_kelas($id_kelas)
    {
        $ret = [];
        $year_now = (int)date("Y");
        for ($i = $year_now; $i <= self::MAX_YEAR; $i++) {
            $ret[] = $i;
        }

        return $ret;
    }

    public static function get_list_bulan_by_kelas_and_tahun($id_kelas, $tahun)
    {
        $list = self::where("id_kelas", $id_kelas)->where("tahun", $tahun)->get();
        $ret = [];

        for ($i = 1; $i <= 12; $i++) {
            $skip = false;
            foreach ($list as $v) {
                if ($v->bulan == $i) {
                    $skip = true;
                    break;
                }
            }

            if ($skip)
                continue;

            $ret[$i] = self::LIST_BULAN[$i - 1];
        }

        return $ret;
    }

    public function get_all_pertanyaan()
    {
        return PertanyaanHarian::where("id_data_harian", $this->id)->orderBy("tipe", "asc")->get();
    }

    public static function count_answer_per_3_ident($id_siswa, $id_data_harian, $tanggal)
    {
        /*
         * Hitung jumlah jawaban dengan filter berikut ini:
         * - id_siswa
         * - tanggal
         * - id_data_harian
         */

        $pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare("
            SELECT COUNT(1) FROM monitoring_harian AS a
            INNER JOIN pertanyaan_data_harian AS b ON b.id = a.id_pertanyaan
            WHERE a.id_siswa = :id_siswa
            AND b.id_data_harian = :id_data_harian
            AND a.tanggal = :tanggal
            AND NOT EXISTS (
                SELECT 1 FROM kunci_monitoring_harian
                WHERE id_siswa = :id_siswa2
                AND id_data_harian = :id_data_harian2
                AND tanggal = :tanggal2
            );
        ");
        $stmt->execute([
            ":id_siswa"        => $id_siswa,
            ":id_data_harian"  => $id_data_harian,
            ":tanggal"         => $tanggal,
            ":id_siswa2"       => $id_siswa,
            ":id_data_harian2" => $id_data_harian,
            ":tanggal2"        => $tanggal
        ]);
        $ret = $stmt->fetch(PDO::FETCH_NUM);
        return (int) $ret[0];
    }
}

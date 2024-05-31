<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ref\Agama;
use App\Models\Ref\Goldar;
use App\Models\Ref\Pendidikan;
use App\Models\KelasSiswa;
use App\Models\Master\TahunAjaran;
use App\Models\Master\Kelas;
use App\Models\Master\KK;
use DB;
use PDO;
use App\Models\Monitoring\Harian as MonitoringHarian;

class Siswa extends Model
{
    protected $fillable = ['id_kk', 'nik', 'nis', 'nama', 'jk', 'agama', 'goldar', 'pendidikan', 'telp', 'tmp_lahir', 'tgl_lahir', 'alamat', 'foto', 'status', 'id_kelas_aktif'];

    protected $table = "siswa";

    public function kelas()
    {
        $id_tahun_ajaran_aktif = TahunAjaran::get_id_tahun_ajaran_aktif();
        $kelas = self::select("kelas.*")
                ->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                ->join("kelas", "kelas.id", "kelas_siswa.id_kelas")
                ->where("kelas.id_tahun_ajaran", $id_tahun_ajaran_aktif)
                ->where("siswa.id", $this->id)
                ->first();
        if (!$kelas) {
            return NULL;
        }

        return Kelas::find($kelas->id);
    }

    public function kk()
    {
       return $this->belongsTo(KK::class, "id_kk")->first();
    }

    public function goldar()
    {
        return $this->belongsTo(Goldar::class, "goldar")->first()->nama ?? NULL;
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, "agama")->first()->nama ?? NULL;
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, "pendidikan")->first()->nama ?? NULL;
    }

    public function status()
    {
        return ucwords($this->status);
    }

    public static function get_siswa_by_id_kelas($id_kelas)
    {
        return self::select(["siswa.*", "kelas_siswa.id_kelas", "kelas_siswa.id as id_kelas_siswa"])
                ->join("kelas_siswa", "siswa.id", "kelas_siswa.id_siswa")
                ->where("kelas_siswa.id_kelas", $id_kelas);
    }

    public static function get_siswa_no_kelas($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);
        $ret = DB::select("SELECT * FROM siswa AS so WHERE NOT EXISTS (
            SELECT siswa.*, kelas_siswa.* FROM
            siswa INNER JOIN kelas_siswa ON siswa.id = kelas_siswa.id_siswa
                  INNER JOIN kelas ON kelas.id = kelas_siswa.id_kelas
                  INNER JOIN tahun_ajaran ON tahun_ajaran.id = kelas.id_tahun_ajaran
            WHERE siswa.id = so.id AND tahun_ajaran.id = ?
         );", [$kelas->id_tahun_ajaran]);
        return $ret;
    }

    public function ayah()
    {
        $ayah = DB::table("orang_tua")
                    ->select("orang_tua.*")
                    ->join("kk", "kk.id", "orang_tua.id_kk")
                    ->join("siswa", "kk.id", "siswa.id_kk")
                    ->where("siswa.id", $this->id)
                    ->where("orang_tua.jk", "L")
                    ->get();
        return $ayah;
    }

    public function ibu()
    {
        $ibu = DB::table("orang_tua")
                    ->select("orang_tua.*")
                    ->join("kk", "kk.id", "orang_tua.id_kk")
                    ->join("siswa", "kk.id", "siswa.id_kk")
                    ->where("siswa.id", $this->id)
                    ->where("orang_tua.jk", "P")
                    ->get();
        return $ibu;
    }

    public function data_siswa($id)
    {
        $siswa = $this->where("id", $id)->first();
        if (!$siswa) {
            return null;
        }

        return $siswa;
    }

    public function get_unasnwered_harian()
    {
        $kelas = $this->kelas();
        $bulan = (int) date("m");
        $tahun = (int) date("Y");
        $hari  = (int) date("d");
        $harian = Harian::where("id_kelas", $kelas->id)
                        ->where("bulan", $bulan)
                        ->where("tahun", $tahun)
                        ->first();

        if (!$harian)
            return [];

        $jawaban = MonitoringHarian::where("id_siswa", $this->id)
                        ->where("tanggal", "LIKE", "{$tahun}-".sprintf("%02d", $bulan)."-%")
                        ->get();

        $list_tanggal = [];
        for ($i = 1; $i <= $hari; $i++) {
            $dt = "{$tahun}-".sprintf("%02d", $bulan)."-".sprintf("%02d", $i);
            $ep = strtotime($dt);
            if (date("Y-m-d", $ep) !== $dt)
                continue;

            $found = false;
            foreach ($jawaban as $j) {
                if ($j->tanggal === $dt) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $list_tanggal[] = $dt;
                continue;
            }
        }

        return $list_tanggal;
    }

    public function get_missing_feedback()
    {
        $pdo = DB::connection()->getPdo();
        $id_siswa = $this->id;
        $stmt = $pdo->prepare("
            SELECT tanggal, id, id_siswa, 'doa' AS tipe FROM monitoring_doa WHERE id_siswa = {$id_siswa} AND feedback IS NULL UNION ALL
            SELECT tanggal, id, id_siswa, 'hadits' AS tipe FROM monitoring_hadits WHERE id_siswa = {$id_siswa} AND feedback IS NULL UNION ALL
            SELECT tanggal, id, id_siswa, 'mahfudhot' AS tipe FROM monitoring_mahfudhot WHERE id_siswa = {$id_siswa} AND feedback IS NULL UNION ALL
            SELECT tanggal, id, id_siswa, 'tahfidz' AS tipe FROM monitoring_tahfidz WHERE id_siswa = {$id_siswa} AND feedback IS NULL UNION ALL
            SELECT tanggal, id, id_siswa, 'tahsin' AS tipe FROM monitoring_tahsin WHERE id_siswa = {$id_siswa} AND feedback IS NULL;
        ");
        $stmt->execute();
        $ret = [];
        while ($tmp = $stmt->fetchObject()) {
            $ret[] = $tmp;
        }
        return $ret;
    }
}

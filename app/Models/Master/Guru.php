<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ref\TraitRef;
use App\Models\Master\Siswa;
use App\Models\Master\OrangTua;
use DB;
use PDO;

class Guru extends Model
{
    use SoftDeletes;
    use TraitRef;

    protected $fillable = ['nik', 'nsm', 'nama', 'email', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'agama', 'pendidikan', 'goldar', 'pekerjaan', 'alamat', 'foto', 'status'];

    protected $table = 'guru';

    public function data_siswa($id)
    {
        $kelas = Kelas::where("id_guru", $id)->first();
        if (!$kelas) {
            return null;
        }

        $siswa_kelas = KelasSiswa::where("id_kelas", $kelas->id)->get();
        if (!$siswa_kelas) {
            return null;
        }

        $data_siswa = [];
        foreach ($siswa_kelas as $s) {
            $data_siswa[] = Siswa::where("id", $s->id_siswa)->first();
        }
        
        return $data_siswa;
    }

    public static function get_unseen_feedback_by_user_id($id_user)
    {
        $pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare("            
            SELECT id, id_siswa, tanggal, feedback, feedback_by, 'doa' AS tipe FROM monitoring_doa WHERE feedback IS NOT NULL and feedback_seen = '0' AND created_by = {$id_user} UNION ALL
            SELECT id, id_siswa, tanggal, feedback, feedback_by, 'hadits' AS tipe FROM monitoring_hadits WHERE feedback IS NOT NULL and feedback_seen = '0' AND created_by = {$id_user} UNION ALL
            SELECT id, id_siswa, tanggal, feedback, feedback_by, 'mahfudhot' AS tipe FROM monitoring_mahfudhot WHERE feedback IS NOT NULL and feedback_seen = '0' AND created_by = {$id_user} UNION ALL
            SELECT id, id_siswa, tanggal, feedback, feedback_by, 'tahfidz' AS tipe FROM monitoring_tahfidz WHERE feedback IS NOT NULL and feedback_seen = '0' AND created_by = {$id_user} UNION ALL
            SELECT id, id_siswa, tanggal, feedback, feedback_by, 'tahsin' AS tipe FROM monitoring_tahsin WHERE feedback IS NOT NULL and feedback_seen = '0' AND created_by = {$id_user};
        ");
        $stmt->execute();
        $ret = [];
        while ($tmp = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $siswa = Siswa::find($tmp["id_siswa"]);
            if (!$siswa) {
                continue;
            }

            $ortu = OrangTua::find($tmp["feedback_by"]);
            if (!$ortu) {
                continue;
            }

            $ret[] = (object) array_merge($tmp, [
                "nama"     => $siswa->nama,
                "nama_ortu" => $ortu->nama,
            ]);
        }
        return $ret;
    }
}

<?php

function generate_back_link(&$orang_tua, &$back_link)
{
    if (isset($_GET["back"])) {
        switch ($_GET["back"]) {
            case "show_anak":
                $back_link = route("orang_tua.show_anak");
                break;
            case "orang_tua":
                $back_link = route("orang_tua.index");
                break;
        }
        $orang_tua = true;
    } else {
        $back_link = route('siswa.kelas', Crypt::encrypt($siswa->id_kelas));
        $orang_tua = false;
    }
}

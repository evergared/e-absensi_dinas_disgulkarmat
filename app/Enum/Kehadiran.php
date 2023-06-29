<?php

namespace App\Enum;

enum Kehadiran : string
{

    case HADIR = 'hadir';
    case TUGAS = 'tugas';
    case CUTI = 'cuti';
    case SAKIT = 'sakit';
    case CADANGAN_LIBUR = 'cadangan libur';
    case TANPA_KETERANGAN = 'alpha';

}

?>
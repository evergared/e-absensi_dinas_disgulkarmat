<?php

namespace App\Models;

use App\Enum\Jadwal;
use App\Enum\Kehadiran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'tanggal',
        'id_pegawai',
        'grup',
        'jadwal',
        'kehadiran',
        'keterangan'
    ];

    protected $casts = [
        'kehadiran' => Kehadiran::class,
        'jadwal' => Jadwal::class
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');
    }
}

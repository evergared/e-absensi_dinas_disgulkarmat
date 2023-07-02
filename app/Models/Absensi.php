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
        'nip',
        'kehadiran',
        'grup',
        'keterangan'
    ];


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}

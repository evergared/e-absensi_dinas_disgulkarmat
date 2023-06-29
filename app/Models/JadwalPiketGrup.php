<?php

namespace App\Models;

use App\Enum\Jadwal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPiketGrup extends Model
{
    use HasFactory;
    protected $table = "jadwal_piket_grup";

    protected $fillable = [
        "tanggal",
        "jadwal",
        "grup"
    ];

    protected $casts = [
        "jadwal" => Jadwal::class
    ];

    
}

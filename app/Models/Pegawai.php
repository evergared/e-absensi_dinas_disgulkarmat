<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasUlids;

    protected 
        $table = "pegawai",
        $primaryKey = "nip";

    protected $fillable = [
        'nama',
        'nrk',
        'nip',
        'email',
        'aktif',
    ];

    protected $casts = [

    ];

    public function jabatan_pegawai()
    {
        return $this->belongsTo(Jabatan::class,'jabatan','id_jabatan');
    }

    public function penempatan_pegawai()
    {
        return $this->belongsTo(Penempatan::class,'penempatan','id_penempatan');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class,'nip','nip');
    }
}

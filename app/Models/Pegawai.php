<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasUlids;

    protected 
        $table = "pegawai",
        $primaryKey = "id";

    protected $fillable = [
        'nama',
        'nrk',
        'nip',
        'email',
        'aktif',
    ];
}

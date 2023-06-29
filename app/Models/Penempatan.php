<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;
    use HasUlids;

    protected 
        $table = 'penempatan',
        $primaryKey = 'id_penempatan';

    protected $fillable = [
        'id_penempatan',
        'nama_penempatan',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'penempatan', 'id_penempatan');
    }
}

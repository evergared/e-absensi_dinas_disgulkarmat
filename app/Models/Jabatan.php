<?php

namespace App\Models;

use App\Enum\Role;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    use HasUlids;

    protected 
        $table = 'jabatan',
        $primaryKey = 'id_jabatan';

    protected $fillable = [
        'id_jabatan',
        'nama_jabatan'.
        'role_enum'
    ];

    protected $casts = [
        'role_enum' => Role::class
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class,'jabatan','id_jabatan');
    }
}

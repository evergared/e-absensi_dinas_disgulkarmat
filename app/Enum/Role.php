<?php

namespace App\Enum;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

enum Role : int
{
    case SUPERADMIN = 0;
    case ADMIN = 1;
    case PIMPINAN = 2;
    case PIMPINAN_APEL = 3;
    case ANGGOTA = 4;

    public static function isSuperAdmin(User|Pegawai|Jabatan $person) : bool
    {
        return self::getRole($person) === self::SUPERADMIN;
    }

    public static function isAdmin(User|Pegawai|Jabatan $person) : bool
    {
        return self::getRole($person) === self::SUPERADMIN || self::getRole($person) === self::ADMIN;
    }

    public static function isPimpinan(User|Pegawai|Jabatan $person) : bool
    {
        return self::getRole($person) === self::PIMPINAN;
    }

    public static function isPemimpinApel(User|Pegawai|Jabatan $person) : bool
    {
        return self::getRole($person) === self::PIMPINAN_APEL;
    }

    public static function isAnggota(User|Pegawai|Jabatan $person) : bool
    {
        return self::getRole($person) === self::ANGGOTA;
    }

    static function getRole(User|Pegawai|Jabatan $person) : Role|bool
    {
        if($person === User::class)
        {
            if($person->override_role)
                $role = $person->override_role_enum;
            else
                $role = $person->data->jabatan->role;
        }
        elseif($person === Pegawai::class)
        {
            $role = $person->jabatan->role;
        }
        elseif($person === Jabatan::class)
        {
            $role = $person->role;
        }
        else
            return false;

        return $role;
    }

}

?>
<?php

namespace Database\Seeders;

use App\Http\Controllers\GrupPiketController;
use App\Models\JadwalPiketGrup;
use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        for($i = 0; $i <4; $i++)
        {
            $pegawai = new Pegawai([
                "nrk" => '123'.$i,
                "nip" => '11111'.$i,
                "nama" => 'User '.$i,
            ]);

            $pegawai->save();
        }

        $pegawai = Pegawai::all()->pluck('id');

        foreach($pegawai as $p)
        {
            $user = new User([
                "id_pegawai" => $p,
                "password" => Hash::make('123456')
            ]);

            $user->save();
        }

        $jadwal_piket = new GrupPiketController;

        $jadwal_piket->buatJadwalPiket(today()->month);
    }
}

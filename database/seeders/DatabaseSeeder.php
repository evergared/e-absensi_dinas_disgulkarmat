<?php

namespace Database\Seeders;

use App\Enum\Role;
use App\Http\Controllers\GrupPiketController;
use App\Models\Jabatan;
use App\Models\JadwalPiketGrup;
use App\Models\Pegawai;
use App\Models\Penempatan;
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

        // seed penempatan
        $penempatan1 = new Penempatan([
            "id_penempatan" => "tempat01",
            "nama_penempatan" => "Sub Bag Jasinfo"
        ]);

        $penempatan2 = new Penempatan([
            'id_penempatan' => "tempat02",
            "nama_penempatan" => "Sub Bag Humas"
        ]);

        $penempatan1->save();
        $penempatan2->save();


        // seed jabatan
        for($i = 0; $i < 4 ; $i++)
        {
            switch($i)
            {
                case 0: $role = Role::ADMIN; $nama_jabatan = "Admin"; break;
                case 1: $role = Role::PIMPINAN; $nama_jabatan = "Kepala Bagian"; break;
                default : $role = Role::ANGGOTA; $nama_jabatan = "Anggota ".$i ;break;
            }

            $test = new Jabatan([
                "nama_jabatan" => $nama_jabatan,
                "role_enum" => $role
            ]);

            $test->save();
        }

        // seed pegawai
        $jabatan = Jabatan::all()->pluck('id_jabatan');
        $a = 0;
        $k = 0;
        $kompi = ["A","B","C"];
        for($i = 0; $i <10; $i++)
        {
            if($k > 2)
                $k = 0;
            $kk = $kompi[$k];

            if($i == 4 || $i == 7)
            {
                $kk = "N";
                $a = 0;
            }

            

            if($i <= 5)
                $p = $penempatan1->id_penempatan;
            else
                $p = $penempatan2->id_penempatan;

            $j = $jabatan[$a];


            $pegawai = new Pegawai([
                "nrk" => '123'.$i,
                "nip" => '11111'.$i,
                "nama" => 'User '.$i,
                "jabatan" => $j,
                "grup" => $kk,
                "penempatan" => $p
            ]);

            $pegawai->save();

            $a++;
            $k++;
        }


        // seed user
        $pegawai = Pegawai::all()->pluck('nip');

        foreach($pegawai as $p)
        {
            $user = new User([
                "nip" => $p,
                "password" => Hash::make('123456')
            ]);

            $user->save();
        }

        // seed jadwal piket
        $jadwal_piket = new GrupPiketController;

        $jadwal_piket->buatJadwalPiket(today()->month);
    }
}

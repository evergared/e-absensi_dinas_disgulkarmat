<?php

namespace Tests\Unit;

use App\Http\Controllers\GrupPiketController;
use App\Models\JadwalPiketGrup;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $d1 = date_create(date('Y').'-'.date('m').'-'.'01');
        $d2 = date_create($d1->format('Y-m-t'));
        $bulan = str_pad('12',2,'0',STR_PAD_LEFT);
        $terakhir = Pegawai::latest('nama')->first()->nama;
        $test = new GrupPiketController;
        // $test->buatJadwalPiket(7);
        // $test->hapusJadwalPiketSebelumnya(6);
        $panggil = Carbon::create('2023', '06', '27')->dayName;
        print_r($panggil);
        $this->assertTrue(true);
    }
}

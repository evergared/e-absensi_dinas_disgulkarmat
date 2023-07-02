<?php

namespace Tests\Unit;

use App\Enum\Role;
use App\Http\Controllers\GrupPiketController;
use App\Models\JadwalPiketGrup;
use App\Models\Pegawai;
use App\Models\User;
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
        $user = User::first();
        print_r($user->data->jabatan_pegawai->nama_jabatan);
        $this->assertTrue($user instanceof User);
    }
}

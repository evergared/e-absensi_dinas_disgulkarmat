<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiketGrup;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Throwable;

class GrupPiketController extends Controller
{

    public function index(Request $r)
    {
        if($r->exists('today'))
        {
            error_log('meminta regu piket hari ini');
            $grup = JadwalPiketGrup::where('tanggal','=',today()->toDateString())->first();
            if(!is_null($grup))
                return $grup->grup;
            else
                return "-";
        }
    }

    public function buatJadwalPiket(int|string $bulan, string $grup_tgl_1 = "A")
    {
        try{
                if(is_int($bulan) || (is_string($bulan) && strlen($bulan)<2))
                    $bulan = str_pad($bulan,2,'0',STR_PAD_LEFT);

                // cek tahun
                $tahun = today()->year;
                if( (int)today()->month > (int)$bulan )
                    $tahun++;

                // dapatkan jumlah hari
                $d1 = date_create(date('Y').'-'.$bulan.'-'.'01');
                $d2 = date_create($d1->format('Y-m-t'));
                $jmlh_hari = date_diff($d1,$d2)->days + 1;

                // insert ke database
                for($i = 1; $i <= $jmlh_hari; $i++)
                {
                    $tanggal = Carbon::create($tahun, $bulan, $i);

                    // piket
                    $grup = $grup_tgl_1;
                    if(JadwalPiketGrup::exists())
                    {
                        $grup_sebelumnya = JadwalPiketGrup::latest('tanggal')->first()->grup;
                        $grup = $this->grupSetelah($grup_sebelumnya);
                    }
                        
                    $piket = new JadwalPiketGrup([
                        'tanggal' => $tanggal->toDateString(),
                        'tipe' => 'piket',
                        'grup' => $grup
                    ]);

                    $piket->save();

                    // lepas
                    $lepas = new JadwalPiketGrup([
                        'tanggal' => $tanggal->toDateString(),
                        'tipe' => 'lepas',
                        'grup' => $this->grupSebelum($grup)
                    ]);

                    $lepas->save();

                    // cadangan
                    if(in_array($tanggal->dayName,["Selasa","Rabu","Kamis"]))
                    {
                        $cadangan = new JadwalPiketGrup([
                            'tanggal' => $tanggal->toDateString(),
                            'tipe' => 'cadangan',
                            'grup' => $this->grupSetelah($grup)
                        ]);
                        $cadangan->save();
                    }
                }
        }
        catch(Throwable $e)
        {
            error_log("Grup Piket Controller error : kesalahan saat membuat jadwal piket at buatJadwalPiket() ".$e);
            exit();
        }
    }

    public function hapusJadwalPiketSebelumnya(int|string $bulan)
    {
        try{

                if(is_int($bulan) || (is_string($bulan) && strlen($bulan)<2))
                    $bulan = str_pad($bulan,2,'0',STR_PAD_LEFT);

                // cek tahun
                $tahun = today()->year;
                if( (int)today()->month < (int)$bulan )
                    $tahun--;

                // dapatkan jumlah hari
                $d1 = date_create(date('Y').'-'.$bulan.'-'.'01');
                $d2 = date_create($d1->format('Y-m-t'));
                $jmlh_hari = date_diff($d1,$d2)->days + 1;

                // delete dari database
                for($i = 1; $i <= $jmlh_hari; $i++)
                {
                    if($piket = JadwalPiketGrup::where('tanggal','=', Carbon::create($tahun, $bulan, $i)->toDateString()))
                        $piket->delete();
                }

        }
        catch(Throwable $e)
        {
            error_log("Grup Piket Controller error : kesalahan saat menghapus jadwal piket at hapusJadwalPiketSebelumnya() ".$e);
            exit();
        }
    }

    private function grupSetelah (string $grup_sebelum)
    {
        $grup = "";
        switch($grup_sebelum)
        {
            case "A" : $grup = "B"; break;
            case "B" : $grup = "C"; break;
            case "C" : $grup = "A"; break;
            default : $grup = $grup_sebelum;
        }
        return $grup;
    }

    private function grupSebelum (string $grup_setelah)
    {
        $grup = "";
        switch($grup_setelah)
        {
            case "A" : $grup = "C"; break;
            case "B" : $grup = "A"; break;
            case "C" : $grup = "B"; break;
            default : $grup = $grup_setelah;
        }
        return $grup;
    }
}

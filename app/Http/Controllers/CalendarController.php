<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class CalendarController extends Controller
{
    protected 
        $apiLibur = "https://www.googleapis.com/calendar/v3/calendars/id.indonesian%23holiday%40group.v.calendar.google.com/events",
        $kodeApiLibur = "AIzaSyAJ4txsiX1wQTJwI23TvLGZYF_JuY53bJ4";

    protected static
        $cacheLibur;

    public 
        $warna_tglMerah = "#fd260083";

    private function fetchLibur()
    {
        error_log("cache libur is null ".is_null($this::$cacheLibur));
        if(is_null($this::$cacheLibur))
            $this::$cacheLibur = Http::get($this->apiLibur,["key"=>$this->kodeApiLibur])['items'];
    }

    public function indexLibur(Request $r)
    {
        try
        {
            $this->fetchLibur();

            $markup = "<div style='background-color : ".$this->warna_tglMerah."'>";

            $data = [];
            foreach ($this::$cacheLibur as $key => $val) 
            {
                // $start = Carbon::parse($val["start"]["date"],"Asia/Jakarta");
                // $end = Carbon::parse($val["end"]["date"],"Asia/Jakarta");

                // $hari = $start->diffInDays($end);
                
                // if($hari = 1)
                    $data[] = [
                        "date" => $val["start"]["date"],
                        "markup" => $markup,
                        "desc" => $val["summary"]
                    ];
            };

            return json_encode($data);
        }
        catch(Throwable $e)
        {
            error_log("calendar controller error : gagal merangkum data libur at indexLibur() ".$e);
            return json_encode([]);
        }
    }

    public function indexPiketGrup(Request $r)
    {
        if($r->has('today'))
        {
            error_log('piket grup memanggil hari ini');
            $today = Carbon::today('Asia/Jakarta')->toDateString();
            $tomorrow = Carbon::tomorrow('Asia/Jakarta')->toDateString();
            
            return;   
        }

        
    }

}

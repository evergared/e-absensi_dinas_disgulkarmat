@extends('layouts.absensi-dinas-dashboard-layout')

@section('content')
        <div class="container-fluid px-4">

            <h1 class="mt-4">Dashboard</h1>
            @include('layouts.others.breadcrumbs')
            
            {{-- start status card --}}
            <div class="card bg-primary text-white text-center mx-auto col-lg-6 mb-3">
                <div class="card-header">
                    <h4>Status Kehadiran Anda di Hari Ini  </h4>
                    <small>({{ now()->format('d-m-Y') }})</small>
                </div>
                <div class="card-body">
                    <h2 class="text-strong"><u>Hadir</u></h2>
                </div>
                <div class="card-footer">
                    Diubah oleh Admin
                </div>
            </div>
            {{-- end status card --}}

            {{-- start kalender --}}
            <div class="row mb-4">
                <div class="col col-lg-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <i class="fa-solid fa-calendar-days"></i> Kalender Nasional
                        </div>
                        <div class="card-body overflow-auto">
                            <small><i>Klik pada tanggal untuk melihat hari libur.</i></small>
                            <div id="kalender-libur">
                            </div>
                        </div>
                        <div class="card-footer">
                            <small id="tgl-libur-skrg">Libur Hari ini <span id="libur-skrg"></span>: </small>
                            <h4 id="tgl-libur-skrg-des">-</h4>
                            <small id="tgl-libur">20 des 2023</small>
                            <h4 id="tgl-libur-des">Hari Libur</h4>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <i class="fa-solid fa-calendar-days"></i> Kalender Regu Piket
                        </div>
                        <div class="card-body overflow-auto">
                            <div id="kalender-piket"></div>
                        </div>
                        <div class="card-footer">
                            <small id="tgl-piket">99 Agustus 1999</small>
                            <h4 id="tgl-piket-des">Bandung</h4>    
                        </div>
                    </div>
                </div>
            </div>

            {{-- end kalender --}}


            @push('stack-head')
                <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/google-calendar@6.1.8/index.global.min.js"></script>
            @endpush

            @push('stack-body')
                <script>

                   document.addEventListener('DOMContentLoaded',function(){
                    var libur = document.getElementById("kalender-libur");
                    var kalenderLibur = new FullCalendar.Calendar(libur,{
                        initialView: 'dayGridMonth',
                        googleCalendarApiKey : 'AIzaSyBya1TO3DIt8pvecV50bAUPxWVQgtWCdWI',
                        locale : 'id',
                        events : {
                            googleCalendarId : 'id.indonesian#holiday@group.v.calendar.google.com',
                        color : 'red',
                        display : 'background',
                        textColor : 'red'
                        },
                        eventTextColor : "#ffffff",
                        eventClick : function (args){
                            console.log(args.event.summary);
                            
                        },
                    });
                    kalenderLibur.render();


                    var piket = document.getElementById("kalender-piket");
                    var kalenderPiket = new FullCalendar.Calendar(piket,{
                        initialView : 'dayGridMonth',
                        googleCalendarApiKey : 'AIzaSyBya1TO3DIt8pvecV50bAUPxWVQgtWCdWI',
                        locale : 'id',
                        events :
                            {
                                googleCalendarId : '5aa7aad35b435458402cd252df0e349a56650cd8d1d9bc7c7ad49b6988abfd4e@group.calendar.google.com',
                            }
                          
                    });
                    kalenderPiket.render();
                   });
                </script>

                <style>
                   
                </style>
            @endpush
            
        
        </div>
@endsection

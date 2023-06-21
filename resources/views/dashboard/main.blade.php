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
                            <small id="tgl-libur">99 Agustus 1999</small>
                            <h4 id="tgl-libur-des">Hari Kebangkitan</h4>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <i class="fa-solid fa-calendar-days"></i> Kalender Piket
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
                <link href="{{asset('css/zabuto_calendar.css')}}" rel="stylesheet">
                <script src="{{asset('js/zabuto_calendar.js')}}"></script>
            @endpush

            @push('stack-body')
                <script>

                    // start konfigurasi kalender
                        var k_libur = $("#kalender-libur");
                        $(document).ready(function () {
                                k_libur.zabuto_calendar({
                                    classname: 'table table-bordered border-black kalender-zabuto',
                                    language: 'id',
                                    navigation_markup:{
                                        prev : '<i class="fa-solid fa-circle-chevron-left"></i>',
                                        next : '<i class="fa-solid fa-circle-chevron-right"></i>'
                                    },
                                    today_markup:'<span class="badge bg-secondary">[day]</span>'
                                });
                            });

                        var k_piket = $("#kalender-piket");
                        $(document).ready(function () {
                                k_piket.zabuto_calendar({
                                    classname: 'table table-bordered border-black kalender-zabuto',
                                    language: 'id',
                                    navigation_markup:{
                                        prev : '<i class="fa-solid fa-circle-chevron-left"></i>',
                                        next : '<i class="fa-solid fa-circle-chevron-right"></i>'
                                    },
                                    today_markup:'<span class="badge bg-secondary">[day]</span>'
                                });
                            });
                    // end konfigurasi kalender

                    // start event kalender

                        k_libur.on('zabuto:calendar:day', function (e){

                        })

                    // end event kalender

                </script>

                <style>
                    table.kalender-zabuto tbody td:nth-child(n+6){
                        background-color: #fd260083;
                        
                    }
                </style>
            @endpush
            
        
        </div>
@endsection

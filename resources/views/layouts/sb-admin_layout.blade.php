<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        <title>{{ config('app.name', 'E-Absensi') . ' | '.  Route::current()->getName()}}</title>
        
        @vite(['resources/js/absensi-dinas.js','resources/css/sb-admin.css'])
         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @stack('stack-head')
    </head>
    <body >

        @include('layouts.nav.sb-admin_dashboard-topnav')

        <div id="layoutSidenav">

            @include('layouts.nav.sb-admin_dashboard-sidebar')

            <div id="layoutSidenav_content">

                <main>
                    @yield('content-frame')
                </main>

                @include('layouts.footer.dashboard-footer')

            </div>
        </div>
        
        @stack('stack-body')
    </body>
</html>

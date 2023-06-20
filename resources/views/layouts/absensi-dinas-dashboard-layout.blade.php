<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        <title>{{ config('app.name', 'E-Absensi') . ' | '.  Route::current()->getName()}}</title>
        
        @vite(['resources/js/absensi-dinas.js','resources/css/sb-admin.css'])
         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body >

        @include('layouts.nav.dashboard-topnav')

        <div id="layoutSidenav">

            @include('layouts.nav.dashboard-sidebar')

            <div id="layoutSidenav_content">

                <main>
                    @yield('content')
                </main>

                @include('layouts.footer.dashboard-footer')

            </div>
        </div>
        
    </body>
</html>

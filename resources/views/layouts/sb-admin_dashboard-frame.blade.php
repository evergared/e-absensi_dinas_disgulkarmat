@extends('layouts.sb-admin_layout')

@section('content-frame')

<div class="container-fluid px-4">

    <h1 class="mt-4">{{$dashboard_title}}</h1>
    @include('layouts.others.sb-admin_breadcrumbs')
    
    @yield('content')

</div>
@endsection
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{route('dashboard')}}"><img src="{{asset('frontend/img/damkar.png')}}" class="img" style="height: 20%; width:20%">E-Absensi</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
    
    <a class="d-none d-lg-block text-white ms-auto me-0 me-md-3 my-2 my-md-0" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        style="text-decoration: none">Logout <i class="fa-solid fa-door-open"></i></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-footer">
            <div class="small">Selamat Datang</div>
            {{auth()->user()->data->nama}}
        </div>
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Beranda</div>
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard"></i></div>
                    Absensi Anda
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('absensi-harian-pribadi')}}">Absensi Harian</a>
                        <a class="nav-link" href="{{route('absensi-apel-pribadi')}}">Absensi Apel</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Absensi</div>
                <a class="nav-link" href="{{route('absensi-harian')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-walkie-talkie"></i></div>
                    Absen Harian
                </a>
                <a class="nav-link" href="{{route('absensi-apel')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-line"></i></div>
                    Absen Apel
                </a>
                <div class="sb-sidenav-menu-heading">Pimpinan</div>
                <a class="nav-link" href="{{route('absensi-anggota')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                    Absensi Anggota Hari Ini
                </a>
                <a class="nav-link" href="{{route('histori-absensi-anggota')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-clock"></i></div>
                    Histori Absensi Anggota
                </a>
                <div class="sb-sidenav-menu-heading">Admin</div>
                <a class="nav-link" href="{{route('data-absensi')}}">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-clock"></i></div>
                    Data Absensi
                </a>
                <a class="nav-link" href="{{route('manage-pegawai')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-gear"></i></div>
                    Kepegawaian
                </a>
                <a class="nav-link" href="{{route('manage-user')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-gear"></i></div>
                    User
                </a>
                <a class="d-block d-sm-none text-white mx-auto mt-2" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        style="text-decoration: none">Logout <i class="fa-solid fa-door-open"></i></a>
            </div>
            
        </div>
        
    </nav>
</div>
        
<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a class='logo-light' href='{{ route('dashboard')}}'>
            <img src="{{ asset('admin/images/logo-light.png') }}" alt="logo" class="logo-lg" height="28">
            <img src="{{ asset('admin/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a class='logo-dark' href='index-2.html'>
            <img src="{{ asset('admin/images/logo-dark.png') }}" alt="dark logo" class="logo-lg" height="28">
            <img src="{{ asset('admin/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='{{ route('dashboard')}}'>
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboards </span>
                    <span class="badge bg-primary rounded ms-auto">01</span>
                </a>
            </li>

            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href="{{ route('Data-siswa') }}">
                    <span class="menu-icon"><i class="bx bx-calendar"></i></span>
                    <span class="menu-text"> Data Siswa </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('Data-petugas') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-file"></i></span>
                    <span class="menu-text"> Data Petugas </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('Data-kelas') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-layout"></i></span>
                    <span class="menu-text"> Data Kelas </span>
                </a>
            </li>

            <li class="menu-title">Transaksi</li>

            <li class="menu-item">
                <a href="{{ route('Transaksi') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-cookie"></i></span>
                    <span class="menu-text"> Pembayaran </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('History') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-briefcase-alt-2"></i></span>
                    <span class="menu-text"> History </span>
                </a>
            </li>

            <li class="menu-title">______________________________</li>

            <li class="menu-item">
                <a href="{{ route('Users') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-aperture"></i></span>
                    <span class="menu-text"> Users </span>

                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('Setting') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bxs-eraser"></i></span>
                    <span class="menu-text"> Setting </span>
                </a>
            </li>
        </ul>
    </div>
</div>
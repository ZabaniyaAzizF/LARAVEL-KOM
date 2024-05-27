<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <?php  $setting = App\Models\Setting::get()->first() ?>
        <!-- Brand Logo Light -->
        <a class='logo-light' href='{{ route('dashboard')}}'>
            <img src="{{ asset('storage/setting/'.$setting->path_logo)}}" class="mb-3" style="" width="70px" alt="">
        </a><br>
    </div>

    <h6 style="position: relative; right: -20px;">{{ $setting->nama }}</h6>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='{{ route('dashboard')}}'>
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboards </span>
                </a>
            </li>

            <li class="menu-item">
                @role('admin|petugas')
                <a href="{{ route('Data-kelas') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-layout"></i></span>
                    <span class="menu-text"> Data Kelas </span>
                </a>
                @endrole
            </li>

            <li class="menu-item">
                @role('admin|petugas')
                <a href="{{ route('Ajaran') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-layout"></i></span>
                    <span class="menu-text"> Tahun Ajaran </span>
                </a>
                @endrole
            </li>

            <li class="menu-title">Transaksi</li>

            <li class="menu-item">
                @role('admin|petugas')
                <a href="{{ route('Transaksi') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-cookie"></i></span>
                    <span class="menu-text"> Spp Bulanan </span>
                </a>
                @endrole
            </li>

            <li class="menu-item">
                @role('admin|petugas')
                <a href="{{ route('Pembayaran') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-cookie"></i></span>
                    <span class="menu-text"> Pembayaran </span>
                </a>
                @endrole
            </li>

            <li class="menu-item">
                @role('siswa')
                <a href="{{ route('History') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-briefcase-alt-2"></i></span>
                    <span class="menu-text"> History Pembayaran </span>
                </a>
                @endrole
            </li>

            <li class="menu-item">
                @role('siswa')
                <a href="{{ route('Tunggakan') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-briefcase-alt-2"></i></span>
                    <span class="menu-text"> Tunggakan SPP </span>
                </a>
                @endrole
            </li>

            <li class="menu-title">______________________________</li>

            <li class="menu-item">
                @role('admin')
                <a href="{{ route('Users') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-aperture"></i></span>
                    <span class="menu-text"> Users </span>
                </a>
                @endrole
            </li>

            <li class="menu-item">
                @role('admin')
                <a href="{{ route('Setting') }}"  class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bxs-eraser"></i></span>
                    <span class="menu-text"> Setting </span>
                </a>
                @endrole
            </li>
        </ul>
    </div>
</div>
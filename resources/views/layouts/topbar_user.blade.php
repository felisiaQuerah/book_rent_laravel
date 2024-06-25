<nav class="navbar navbar-expand navbar-light text-info">
    @if(auth()->user()->role !== 'user')
        <a class="sidebar-toggle js-sidebar-toggle text-info">
            <i class="fa fa-list align-self-center"></i>
        </a>
    @endif

    <div class="col-lg-4 col-sm-4 logo d-flex align-items-center gap-3 mb-3 mb-lg-0 mb-md-0">
        <div class="d-flex flex-column">
            <h1 class="text-white"><a href="{{ route('home') }}" class="text-decoration-none fw-bold text-white">
                    {{-- {!! get_my_app_config('nama_web') !!} --}}
                    <img src="{{ asset(get_my_app_config('logo')) }}" style="width:133px !important" alt="logo">
                </a></h1>

        </div>
    </div>
    <div class="navbar-collapse collapse ">
        <ul class="navbar-nav navbar-align">
            @if(auth()->user()->role == 'user')
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}" tooltip="Beranda">
                        Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('user.history*')) active @endif" href="{{ route('user.history') }}" tooltip="Riwayat Sewa">
                        Riwayat </a>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="align-middle me-1"
                            data-feather="user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="align-middle me-1" data-feather="log-out"></i>
                            Sign out</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

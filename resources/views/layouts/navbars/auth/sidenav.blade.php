<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}"
            target="_blank">
            <img src="./img/money.jpg" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Fast Money</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            @if (in_array(Auth::user()->role, ['admin']))	
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'admin' ? 'active' : '' }}" href="{{ route('admin') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Admin</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}" href="{{ route('users') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-circle text-dark text-sm opacity-10"></i>


                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            @endif

            @if (in_array(Auth::user()->role, ['user']))
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @endif
            
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'log' ? 'active' : '' }}" href="{{ route('log') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-history text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Histori</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'electricBill' ? 'active' : '' }}" href="{{ route('electricBill') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-bolt text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Token Listrik</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'internetBill' ? 'active' : '' }}" href="{{ route('internetBill') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-wifi text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Layanan Internet/TV Kabel</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'creditBill' ? 'active' : '' }}" href="{{ route('creditBill') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-mobile text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pulsa</span>
                </a>
            </li>
            
            {{-- @if (auth()->user()->is_admin == 1)
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'admin-saldo' ? 'active' : '' }}" href="{{ route('admin-saldo') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-send text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Isi Saldo User</span>
                </a>
            </li> --}}


            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>


            {{-- LOGOUT BUTTON --}}
            <li class="nav-item">
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form" >
                    @csrf
                    <a style="padding-left: 25px" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-dark font-weight-bold">
                        <i class="fa fa-sign-out text-sm opacity-10" aria-hidden="true"></i>
                        <span class="nav-link-text ms-1">Log out</span>
                    </a>
                </form>
            </li>
            
            {{-- <div class="text-center">
                <div class="col-auto my-2">
                    <a class="btn bg-gradient-dark mb-0" href="/isi"><i class="fa fa-arrow-up"></i>&nbsp;&nbsp;Isi Saldo</a>
                </div>
                <div class="col-auto my-2">
                    <a class="btn bg-gradient-dark mb-0" href="/kirim"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Kirim Saldo</a>
                </div>
            </div> --}}

                
        </ul>
    </div>
    <div class="sidenav-footer mx-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0 border">
                <div class="docs-info">
                    <h6 class="mt-5">Dibuat Oleh</h6>
                    <p class="text-xs font-weight-bold"> Ferdinand Maulana Za Fauzi </p>
                </div>
            </div>
        </div>
    </div>
</aside>

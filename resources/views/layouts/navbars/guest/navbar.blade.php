<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav
                class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                <div class="container-fluid">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('home') }}">
                        Fast Money
                    </a>
                        <ul class="navbar-nav d-lg-block d-none">
                            <li class="nav-item">
                                @php
                                    if ($title == "register") {
                                        $sign = "Sign in";
                                        $link = "/login";
                                    } else if ($title == "login"){
                                        $sign = "Sign up";
                                        $link = "/register";
                                    } else {
                                        $sign = "Kembali";
                                        $link = "/billing";
                                    }
                                @endphp
                                <a href="{{ $link }}" class="btn btn-sm mb-0 me-1 btn-primary">{{ $sign }}</a>
                            </li>
                        </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>

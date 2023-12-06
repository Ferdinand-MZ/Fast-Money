@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{ route('home') }}">
           Fast Money
        </a>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                    <a href="/sign-in-static"
                        class="btn btn-sm mb-0 me-1 bg-gradient-light">Sign In</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                    <p class="text-lead text-white">
                        Buat akun baru untuk mendaftar dan mendapat akses aplikasi e-wallet & rasakan kemudahan transaksi secara online.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">

                    <div class="card-header text-center pt-4">
                        <h5>Register</h5>
                    </div>

                    <div class="card-body">
                        <form role="form">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Name" aria-label="Name">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" aria-label="Email">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password"
                                    aria-label="Password">
                            </div>
                            <div class="mb-3">
                                <input type="date" class="form-control" placeholder="Tanggal Lahir"
                                    aria-label="tgl_lahir">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" placeholder="Nomer Telepon"
                                    aria-label="no_telepon">
                            </div>
                            <div class="form-check form-check-info text-start">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and
                                        Conditions</a>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="/sign-in-static"
                                    class="text-dark font-weight-bolder">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
<footer class="footer py-5">
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Ferdinand Maulana Za Fauzi
                </p>
            </div>
        </div>
    </div>
</footer>
@endsection

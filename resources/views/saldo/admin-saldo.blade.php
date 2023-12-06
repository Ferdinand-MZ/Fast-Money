@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-10 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Hallo Admin!</h1>
                        <p class="text-lead text-white">Ini merupakan laman admin dimana anda sebagai admin dapat mengisi saldo para nasabah sesuai keinginan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Isi Saldo Nasabah</h5>
                        </div>
                        <div class="card-body pt-0">
                            <form method="POST" action="{{ route('register.perform') }}">
                                @csrf
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="username" class="form-control" placeholder="Username Nasabah" aria-label="Name" value="{{ old('username') }}">
                                    @error('username') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email Nasabah" aria-label="Email" value="{{ old('email') }}">
                                    @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="number" name="no-hp" class="form-control" placeholder="No Telepon Nasabah" value="" >
                                    @error('no-hp') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="number" name="no-rek" class="form-control" placeholder="No Rekening Nasabah" value="" >
                                    @error('no-rek') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>

                                <div class="flex flex-col mb-2">
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="" for=""><h4>Rp. </h4></label>
                                        </div>
                                        <div class="col-10">
                                            <input type="number" name="saldo-admin" class="form-control" placeholder="Nomial Saldo" aria-label="Name" value="{{ old('username') }}">
                                        </div>
                                    </div>
                                        @error('saldo-admin') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>

                                <div class="form-check form-check-info text-start my-3">
                                    <input class="form-check-input" type="checkbox" name="terms" id="flexCheckDefault" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Data Nasabah <a href="javascript:;" class="text-dark font-weight-bolder">Sudah Benar</a>
                                    </label>
                                    @error('terms') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100">Kirim</button>
                                </div>
                                <div class="text-center">
                                    <a href="/billing" class="btn bg-transparant w-100 border">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footers.guest.footer')
@endsection

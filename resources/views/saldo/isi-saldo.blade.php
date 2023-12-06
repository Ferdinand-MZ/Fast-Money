@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0 mb-5">
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
                                    <a href="/kirim" class="btn btn-sm mb-0 me-1 btn-primary">Kirim Saldo</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content">
        <section>
            <div class="page-header min-vh-100 mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    
                                    <h4 class="font-weight-bolder"><a href="/dashboard"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;Isi Saldo</h4>
                                    <p class="mb-0"></p>
                                </div>

                                @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif


                                <form action="{{ route('wallet.submit') }}" method="post" onsubmit="return confirm('Yakin ingin menambahkan saldo nya ?')">
                                    @csrf
                                <div class="card-body py-0">

                                    <div class="text-center">
                                        <div class="flex flex-col mb-3">
                                            <br>
                                            <input type="number" name="no_telp" class="form-control" placeholder="Nomer Telepon" aria-label="no_telp">
                                            @error('no_telp') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <div class="text-start w-100 mt-4 mb-0 py-0"></div>
                                    <div class="text-center">
                                        <div class="flex flex-col mb-3">
                                        <input type="number" name="saldo" class="form-control" placeholder="Jumlah Uang" aria-label="saldo">
                                        @error('saldo') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                                </div>
                            </form>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Mau Lakukan Transaksi ?
                                        <a href="/kirim" class="text-primary text-gradient font-weight-bold">Transaksi</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg'); background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                                    currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more
                                    effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('.dropdown-item').click(function () {
            var selectedWallet = $(this).data('wallet');
            $('#walletDropdown').text(selectedWallet);
        });
    });
</script>

        </section>
    </main>
    
@endsection

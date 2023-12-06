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
                                    <a href="/kirim" class="btn btn-sm mb-0 me-1 btn-primary">isi Saldo</a>
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

                               <form role="form" method="post" action="{{ route('storeInternetBill') }}">
                                @csrf
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">
                                        <a href="/kirim"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;Layanan TV kabel/Internet
                                    </h4>
                                    <p class="mb-0"></p>
                                </div>

                                <div class="card-body py-0">
                                    <div class="text-center">
                                        <div class="text-start w-100 mt-4 mb-0 py-0 pb-1">&nbsp;Customer ID</div>
                                        <div class="mb-3">
                                            <input type="text" name="customer_id" class="form-control form-control-lg" placeholder="Ketikkan id pelanggan" aria-label="customer_id">
                                            @error('customer_id') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                        </div>

                                        <div class="text-center">
                                            <div class="text-start w-100 mt-4 mb-0 py-0 pb-1">&nbsp;Daftar Penyedia</div>
                                            <div class="mb-3">
                                                <select class="form-control form-control-lg" aria-label="Daftar Penyedia" name="nama_penyedia">
                                                    <option value="KVision">KVision</option>
                                                    <option value="MNC Play">MNC Play</option>
                                                    <option value="MNC Vision">MNC Vision</option>
                                                    <option value="MyRepublic">MyRepublic</option>
                                                    <option value="PowerTel">PowerTel</option>
                                                    <option value="SISNET">SISNET</option>
                                                    <option value="TransVision">TransVision</option>
                                                    <option value="XL Home">XL Home</option>
                                                </select>
                                            </div>
                                            @error('nama_penyedia') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                        </div>

                                        <div class="text-center">
                                            <div class="text-start w-100 mt-4 mb-0 py-0 pb-1">&nbsp;Jumlah</div>
                                            <div class="mb-3">
                                                <select class="form-control form-control-lg" aria-label="Jumlah" name="harga">
                                                    <option value="50000">50.000</option>
                                                    <option value="100000">100.000</option>
                                                    <option value="150000">150.000</option>
                                                    <option value="200000">200.000</option>
                                                    <option value="300000">300.000</option>
                                                    <option value="400000">400.000</option>
                                                    <option value="500000">500.000</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @error('harga') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-2 mb-0">Kirim</button>
                                </div>
                                <a href="billing" class="text-center">
                                    <button type="button" class="btn btn-lg btn-transparent btn-lg w-100 mt-2 mb-0 border">Kembali</button>
                                </a>
                            </form>
                                    </div>
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
        </section>
    </main>
    
@endsection

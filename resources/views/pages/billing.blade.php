@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="d-flex w-100 align-items-start gap-3">
            <div class="card bg-transparent shadow-xl w-45">
                <div class="overflow-hidden position-relative border-radius-xl"
                     style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body position-relative z-index-1 p-3">
                        <i class="fas fa-wifi text-white p-2"></i>
                        <h5 class="text-white mt-4 mb-5 pb-2">{{ auth()->user()->no_telp ?? 'No. Telepon' }}</h5>

                        <div class="d-flex">
                            <div class="d-flex">
                                <div class="me-4">
                                    <p class="text-white text-sm opacity-8 mb-0">Nama Pengguna</p>
                                    <h6 class="text-white mb-0">{{ auth()->user()->fullname ?? 'fullname' }}</h6>
                                </div>

                            </div>
                            <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                <img class="w-60 mt-2" src="/img/logos/mastercard.png" alt="logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card saldo-card w-25">
                <div class="col-12">
                    <div class="row my-0 text-center">
                        <div class="col-7">
                            <a class="btn bg-gradient-dark mb-0 px-2" href="/isi"><i class="fa fa-money"></i>&nbsp;&nbsp;<br>Isi
                                Saldo/Kirim Saldo</a>
                        </div>
                        <div class="col-4">
                            <a class="btn bg-gradient-dark mb-0 px-2" href="/kirim"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Transaksi</a>
                        </div>

                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header mx-4 p-3 text-center">
                    <div
                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                        <i class="fas fa-landmark opacity-10"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-4 text-center" style="height: 90px; width: 400px;">
                    <h6 class="text-center mb-0">Jumlah Saldo</h6>
                    <hr class="horizontal dark my-2">
                    <h5 class="mb-0">Rp. {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Histori Transaksi</h6>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-outline-primary btn-sm mb-0"
                         onclick="window.location.href='{{ route('log') }}';"
                        >Lihat Semua</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-3 pb-0">
                <ul class="list-group">
                    @if(isset($log) && count($log) > 0)
                        @foreach ($log as $logEntry)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $logEntry->fullname }}</h6>
                                    <span class="text-xs">{{ $logEntry->activity }}</span>
                                </div>
                                <div class="d-flex align-items-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">{{ $logEntry->id }}</span>
                                    <span class="text-secondary text-xs font-weight-bold">{{ $logEntry->created_at }}</span>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item border-0 text-center">
                            Data Tidak Ditemukan
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Informasi Billing</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Oliver Liam</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="far fa-trash-alt me-2"></i>Hapus</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Lucas Harper</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Stone Tech Zone</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">lucas@stone-tech.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="far fa-trash-alt me-2"></i>Hapus</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Ethan James</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Fiber Notion</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">ethan@fiber.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="far fa-trash-alt me-2"></i>Hapus</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5 mt-4">
            <div class="card h-100 mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Transaksi</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <i class="far fa-calendar-alt me-2"></i>
                            <small>23 - 30 Maret 2023</small>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Terbaru</h6>
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-down"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                                    <span class="text-xs">27 Maret 2023, 12:30 PM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                - $ 2,500
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-up"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Apple</h6>
                                    <span class="text-xs">27 Maret 2023, 04:30 AM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                + $ 2,000
                            </div>
                        </li>
                    </ul>
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Kemarin</h6>
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-up"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                                    <span class="text-xs">26 Maret 2023, 13:45 PM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                + $ 750
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-up"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">HubSpot</h6>
                                    <span class="text-xs">26 Maret 2023, 12:30 PM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                + $ 1,000
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-up"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Creative Tim</h6>
                                    <span class="text-xs">26 Maret 2023, 08:30 AM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                + $ 2,500
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-exclamation"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Webflow</h6>
                                    <span class="text-xs">26 Maret 2023, 05:00 AM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                                Pending
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
    @include('layouts.footers.auth.footer')
    </div>
@endsection
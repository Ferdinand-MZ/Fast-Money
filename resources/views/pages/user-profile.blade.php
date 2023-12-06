@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="/img/{{ auth()->user()->picture }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->fullname ?? 'Fullname' }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ ( auth()->user()->is_admin == 1) ? 'Admin' : 'user'}}
                        </p>
                    </div>
                </div>
                <form role="form" method="POST" action="{{ route('profile.update.picture') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <input type="file" name="picture" accept="image/*">
                    </div>
                
                    <button type="submit" class="btn btn-primary">Update Profile Picture</button>
                </form>
                
            </div>
        </div>
    </div>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mx-2">Hapus Profil</button>
                    </form>
                    
                    <form role="form" method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Informasi User</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" name="fullname"  value="{{ old('fullname', auth()->user()->fullname) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Username</label>
                                        <input class="form-control" type="text" name="username" value="{{ old('username', auth()->user()->username) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input class="form-control" type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tanggal Lahir</label>
                                        <input class="form-control" type="date" name="tgl_lahir" value="{{ old('tgl_lahir', auth()->user()->tgl_lahir) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nomer Telepon</label>
                                        <input class="form-control" type="number" name="no_telp" value="{{ old('no_telp', auth()->user()->no_telp) }}">
                                    </div>
                                </div>
                            </div>
                            {{-- <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Contact Information</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Alamat</label>
                                        <input class="form-control" type="text" name="address"
                                            value="{{ old('address', auth()->user()->address) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kota</label>
                                        <input class="form-control" type="text" name="city" value="{{ old('city', auth()->user()->city) }}">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Negara</label>
                                        <input class="form-control" type="text" name="country" value="{{ old('country', auth()->user()->country) }}">
                                    </div>
                                </div> --}}
                                {{-- ini yang bisa dipake --}}
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Negara</label>
                                        <select name="country" id="" class="form-control">
                                            <option value="Belum Pilih" selected="">Pilih Negara</option>
                                            <option value="Indonesia" {{ (old('country', auth()->user()->country) == "Indonesia") ? 'selected' : '' }}>Indonesia</option>
                                            <option value="Brasil"  {{ (old('country', auth()->user()->country) == "Brasil") ? 'selected' : '' }}>Brasil</option>
                                            <option value="Great Britain"  {{ (old('country', auth()->user()->country) == "Great Britain") ? 'selected' : '' }}>Great Britain</option>
                                            <option value="Germany"  {{ (old('country', auth()->user()->country) == "Germany") ? 'selected' : '' }}>Germany</option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kode Post</label>
                                        <input class="form-control" type="text" name="postal" value="{{ old('postal', auth()->user()->postal) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">No Telepon</label>
                                        <input class="form-control" type="text" name="hp" value="{{ old('hp', auth()->user()->hp) }}">
                                    </div>
                                </div> --}}
                                
                            </div>
                            {{-- <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Tentangku</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tentangku</label>
                                        <input class="form-control" type="text" name="about"
                                            value="{{ old('about', auth()->user()->about) }}">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @include('layouts.navbars.auth.topnav', ['title' => 'Users'])
    @if (in_array(Auth::user()->role, ['admin']))
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar User</h3>
        </div>
        
        <form action="{{ route('users') }}" method="get">
            <div class="input-group">
            <input type="search" name="search" class="form-control" placeholder="Masukkan Username/Fullname" value="{{ $vcari }}">
            
            <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            </form>

        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            <div>
                <a href="{{ route('pdf.allUsers') }}" class="btn btn-info"><i class="fas fa-download"></i> Unduh Daftar</a>
            </div>
            <button type="button" class="btn btn-success" id="tambahDataBtn"><i class="fas fa-plus-circle"></i> Tambah Data</button>
            <div class="btn-group">
                <button class="btn btn-warning edit-btn">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div> 
            <!-- Add a section for displaying the add data form -->
            <div id="addDataForm" style="display: none;">
                <h6>Add Data</h6>
                <!-- Your form for adding data -->
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
        
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
        
                    <div class="form-group">
                        <label for="fullname">Fullname :</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir :</label>
                        <input type="date" name="tgl_lahir" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="no_telp">Nomer Telepon :</label>
                        <input type="number" name="no_telp" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="string" name="password" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            
            <script>
                $(document).ready(function () {
                    // When the "Tambah Data" button is clicked
                    $("#tambahDataBtn").click(function () {
                        // Toggle the visibility of the form
                        $("#addDataForm").slideToggle();
                    });
                });
            </script>

<div id="editDataForm" style="display: none;">
    <h6>Edit Data</h6>
    <!-- Your form for inline editing -->
    @foreach ($users as $user)
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Username</label>
            <input name="username" type="text" class="form-control" placeholder="..."  value="{{ $user->username }}">
            @error('username')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Fullname</label>
            <input name="fullname" type="text" class="form-control" placeholder="..."  value="{{ $user->fullname }}">
            @error('fullname')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" type="text" class="form-control" placeholder="..." 
            value="{{ $user->email }}">
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input name="tgl_lahir" type="date" class="form-control" placeholder="..." 
            value="{{ $user->tgl_lahir }}">
            @error('tgl_lahir')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Nomer Telepon</label>
            <input name="no_telp" type="number" class="form-control" placeholder="..." 
            value="{{ $user->no_telp }}">
            @error('no_telp')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Saldo</label>
            <input name="saldo" type="number" class="form-control" placeholder="..." 
            value="{{ $user->saldo }}">
            @error('number')
                <p>{{ $message }}</p>
            @enderror
        </div>
          <input type="submit" name="submit" class="btn btn-primary" value="Edit">
        <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancel</button>
    </form>
    @endforeach
</div>

<script>
    $(document).ready(function () {
        // When the "Edit" button is clicked
        $(".edit-btn").click(function () {
            // Populate the form fields with current row data
            var row = $(this).closest('tr');
            var username = row.find('td:eq(1)').text();
            var harga = row.find('td:eq(3)').text();
            var userId = row.find('td:eq(0)').data('user-id');

            $("#edit_username").val(username);
            $("#edit_harga").val(harga);
            $("#edit_user_id").val(userId);

            // Show the edit form
            $("#editDataForm").slideDown();
        });

        // When the "Cancel" button is clicked
        $("#cancelEditBtn").click(function () {
            // Hide the edit form
            $("#editDataForm").slideUp();
        });

        // When the inline edit form is submitted
        $("#inlineEditForm").submit(function (e) {
            e.preventDefault();

            // Perform the inline update using AJAX
            $.ajax({
                url: '/electricBill/' + electricBillId, // Replace with your update route
                method: 'PATCH',
                data: $(this).serialize(),
                success: function (response) {
                    // Handle success, e.g., update the row in the table
                    // You might need to refresh the entire page or update the row dynamically
                    // based on your application structure
                    console.log(response);
                    $("#editDataForm").slideUp();
                },
                error: function (error) {
                    // Handle errors
                    console.log(error);
                }
            });
        });
    });
</script>


            <table class="table table-striped table-bordered">
                <tr>
                    <th style="text-align: center; vertical-align: middle;">Username</th>
                    <th style="text-align: center; vertical-align: middle;">Fullname</th>
                    <th style="text-align: center; vertical-align: middle;">Email</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal Lahir</th>
                    <th style="text-align: center; vertical-align: middle;">Nomer Telepon</th>
                    <th style="text-align: center; vertical-align: middle;">Saldo</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                    <th style="text-align: center; vertical-align: middle;">Aksi</th>   
                </tr>
                @if($users->count() > 0)
                @foreach ($users as $products)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->username }}</td>
                    <td style="text-align: center; vertical-align: middle;"> {{ $products->fullname}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->email }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->tgl_lahir }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->no_telp }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->saldo }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->created_at }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                    
                    
                    <form action="{{ route('users.destroy', $products->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="border-radius: 10px; margin-left: 5px;" onclick="return confirm('Konfirmasi Hapus Data !?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                    {{-- <a href="{{ route('pdf.electricBill', ['id' => $products->id]) }}" class="btn btn-info">
                        <i class="fas fa-download"></i> Struk
                    </a> --}}
                </div>
                    </td>
                </tr>
                

                @endforeach
                @else
                <tr>
                    <td colspan="3" style="text-align: center; vertical-align: middle;">Data Tidak Ditemukan</td>
                </tr>
                @endif
            </table>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
    </div>
    
    @endif

@endsection
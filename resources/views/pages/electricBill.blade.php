@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @include('layouts.navbars.auth.topnav', ['title' => 'Token Listrik'])
    @if (in_array(Auth::user()->role, ['user']))
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Histori</h6>
                    </div>

                   	
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor Meter</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Token Listrik</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Harga</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                            <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Unduh</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    @if($electricBills->count()> 0)
                                    @foreach ($electricBills as $log)
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                               
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-xs text-secondary mb-0">{{ $log->id }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0">{{ $log->fullname}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{$log->meter_number}}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{$log->token_listrik}}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{$log->harga}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$log->created_at}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('pdf.electricBill', ['id' => $log->id]) }}" class="btn btn-info">
                                                <i class="fas fa-download"></i> Struk
                                            </a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    
                                    @else
                                    <tr>
                                        <td colspan="4" style="text-align: center; vertical-align: middle;">Data Tidak Ditemukan</td> 
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- @include('layouts.footers.auth.footer') --}}
    </div>
    @endif

    @if (in_array(Auth::user()->role, ['admin']))
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Transaksi Token Listrik</h3>
        </div>
        
        <form action="{{ route('electricBill') }}" method="get">
            <div class="input-group">
            <input type="search" name="search" class="form-control" placeholder="Masukan fullname, tanggal, atau meter number" value="{{ $vcari }}">
            
            <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            </form>

        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            <div>
                <a href="{{ route('pdf.allElectricBill') }}" class="btn btn-info"><i class="fas fa-download"></i> Unduh Daftar</a>
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
                <form method="POST" action="{{ route('electricBill.storeForUser') }}">
                    @csrf
        
                    <div class="form-group">
                        <label for="meter_number">Meter Number:</label>
                        <input type="text" name="meter_number" class="form-control" required>
                    </div>
        
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Choose User:</label>
                        <select name="user_id" class="form-control" required>
                            <!-- Assuming $users is an array or collection of user objects -->
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                            @endforeach
                        </select>
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
    @foreach ($electricBills as $electricBill)
    <form action="{{ route('electricBill.update', $electricBill->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Meter Number</label>
            <input name="meter_number" type="number" class="form-control" placeholder="..."  value="{{ $electricBill->meter_number }}">
            @error('meter_number')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Token Listrik</label>
            <input name="token_listrik" type="number" class="form-control" placeholder="..."  value="{{ $electricBill->token_listrik }}">
            @error('token_listrik')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input name="harga" type="number" class="form-control" placeholder="..." 
            value="{{ $electricBill->harga }}">
            @error('harga')
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
            var meterNumber = row.find('td:eq(1)').text();
            var harga = row.find('td:eq(3)').text();
            var userId = row.find('td:eq(0)').data('user-id');

            $("#edit_meter_number").val(meterNumber);
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
                    <th style="text-align: center; vertical-align: middle;">Fullname</th>
                    <th style="text-align: center; vertical-align: middle;">Meter Number</th>
                    <th style="text-align: center; vertical-align: middle;">Token Listrik</th>
                    <th style="text-align: center; vertical-align: middle;">Harga</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                    <th style="text-align: center; vertical-align: middle;">Aksi</th>   
                </tr>
                @if($electricBills->count() > 0)
                @foreach ($electricBills as $products)
                <tr>
                    <td style="text-align: center; vertical-align: middle;"> {{ $products->fullname}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->meter_number }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->token_listrik }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->harga }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $products->created_at }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                    
                    
                    <form action="{{ route('electricBill.destroy', $products->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" style="border-radius: 10px; margin-left: 5px;" onclick="return confirm('Konfirmasi Hapus Data !?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                    <a href="{{ route('pdf.electricBill', ['id' => $products->id]) }}" class="btn btn-info">
                        <i class="fas fa-download"></i> Struk
                    </a>
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
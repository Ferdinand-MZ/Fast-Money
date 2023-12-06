<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectricBill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use Illuminate\Support\Str;


class ElectricbillController extends Controller
{
    public function create()
    {
        $electricBills = ElectricBill::all();
        return view('pages.electricBill_create', [compact('electricBills')]);
    }
    public function destroy($id)
    {
        ElectricBill::where('id', $id)->delete();
        return redirect()->route('electricBill')->with('success', 'Produk berhasil dihapus');
    }
//    public function storeElectricBill(Request $request)
//    {
//        // Validate the form data
//        $request->validate([
//          'meter_number' => 'required|string|min:11|max:12',
//          'harga' => 'required|numeric',
//      ]);
 
//      $user = Auth::user();

//        if ($user->saldo >= $request->input('harga')) {
//         // Create a new ElectricBill instance and associate it with the user
//         $electricBill = $user->electricBills()->create([
//             'meter_number' => $request->input('meter_number'),
//             'harga' => $request->input('harga'),
//             'fullname' => $user->fullname,
//             'token_listrik' => rand(100000000000, 999999999999),
//             // Add any other fields as needed
//         ]);

//         $Log = Log::create([
//             'id_user' => Auth::user()->id,
//             'activity' => 'Anda Melakukan transaksi Token Listrik'
//         ]);

//         // Deduct the balance from the user
//         $user->saldo -= $electricBill->harga;
//         $user->save();


//         // Redirect back or to a specific route
//         return redirect()->route('home')->with('success', 'Electric bill added successfully');
//     } else {
//         // Redirect back with an error message if the user has insufficient balance
//         return redirect()->route('home')->with('error', 'Insufficient balance to make the transaction');
//     }
        
//    }

public function storeElectricBill(Request $request)
{
    // Validate the form data
    $request->validate([
        'meter_number' => 'required|string|min:11|max:12',
        'harga' => 'required|numeric',
    ]);

    $user = Auth::user();

    // Check if the user has sufficient balance, except for admin users
    if ($user->role !== 'admin' && $user->saldo < $request->input('harga')) {
        // Redirect back with an error message if the user has insufficient balance
        return redirect()->route('home')->with('error', 'Insufficient balance to make the transaction');
    }

    // Create a new ElectricBill instance and associate it with the user
    $electricBill = $user->electricBills()->create([
        'meter_number' => $request->input('meter_number'),
        'harga' => $request->input('harga'),
        'fullname' => $user->fullname,
        'token_listrik' => rand(100000000000, 999999999999),
        // Add any other fields as needed
    ]);

    // Log the transaction
    $log = Log::create([
        'id_user' => $user->id,
        'activity' => 'Anda Melakukan transaksi Token Listrik'
    ]);

    // Deduct the balance from the user (skip for admin users)
    if ($user->role !== 'admin') {
        $user->saldo -= $electricBill->harga;
        $user->save();
    }

    // Redirect back or to a specific route
    return redirect()->route('home')->with('success', 'Electric bill added successfully');
}

public function storeElectricBillForUser(Request $request)
{
    // Validasi input dari formulir
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'meter_number' => 'required|string|min:11|max:12',
        'harga' => 'required|numeric',
    ]);

    // Mendapatkan pengguna dari ID yang dipilih
    $user = User::findOrFail($request->input('user_id'));

    // Buat transaksi dan asosiasikan dengan pengguna yang dipilih
    $electricBill = $user->electricBills()->create([
        'meter_number' => $request->input('meter_number'),
        'harga' => $request->input('harga'),
        'token_listrik' => rand(100000000000, 999999999999),
        'fullname' => $user->fullname,
        // Tambahkan kolom lain sesuai kebutuhan
    ]);

    // Log transaksi
    $log = Log::create([
        'id_user' => Auth::id(),
        'activity' => 'Admin membuat transaksi Token Listrik untuk pengguna ' . $user->fullname,
    ]);

    // Redirect atau berikan respons sesuai kebutuhan
    return redirect()->route('home')->with('success', 'Transaksi token listrik berhasil ditambahkan untuk ' . $user->fullname);
}

// public function showElectricBillsView()
// {
//     $vcari = request('search');
//     $electricBills = ElectricBill::search(request('search'))->paginate(10);
//     // Retrieve all users (you may want to use this data for something else)
//     $users = User::all();

//     // Retrieve the authenticated user
//     $user = Auth::user();

//     // Check if the user is an admin
//     if ($user->role === 'admin') {
//         // If the user is an admin, retrieve all electric bills
//         $electricBills = ElectricBill::all();
//     } else {    
//         // If the user is not an admin, retrieve only the electric bills associated with the user
//         $electricBills = $user->electricBills;
//     }

//     // Pass the electricBills and user variables to the view
//     return view('pages.electricBill', compact('electricBills', 'vcari', 'user', 'users'));
// }

public function showElectricBillsView()
{
    $vcari = request('search');
    $user = Auth::user();

    // Retrieve all users (you may want to use this data for something else)
    $users = User::all();

    // Check if a search query is present
    if ($vcari) {
        // If there is a search query, perform the search
        $electricBills = ElectricBill::search($vcari)->paginate(10);
    } else {
        // If no search query, check if the user is an admin
        if ($user->role === 'admin') {
            // If the user is an admin, retrieve all electric bills
            $electricBills = ElectricBill::paginate(10);
        } else {
            // If the user is not an admin, retrieve only the electric bills associated with the user
            $electricBills = $user->electricBills()->paginate(10);
        }
    }

    // Pass the electricBills and user variables to the view
    return view('pages.electricBill', compact('electricBills', 'vcari', 'user', 'users'));
}


public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'meter_number' => 'required',
        'token_listrik' => 'required',
        'harga' => 'required',
    ]);

    // Use only the validated fields from the request
    $data = $request->only(['meter_number', 'token_listrik', 'harga']);

    // Update the record in the database
    ElectricBill::where('id', $id)->update($data);

    // Redirect to the correct route
    return redirect()->route('electricBill')->with('success', 'Produk berhasil diperbaharui');
}

public function edit($id)
    {
        $electricBill = ElectricBill::find($id);
        return view('pages.electricBill', compact('data'));
    }

    






//     {
//         $user = Auth::user();

//         if ($user->role === 'admin') {
//             // If the user is an admin, retrieve all electric bills
//             $electricBills = ElectricBill::all();
//         } else {    
//             // If the user is not an admin, retrieve only the electric bills associated with the user
//             $electricBills = $user->electricBills;
//         }

//         // Pass the electricBills variable to the view
//         return view('pages.electricBill')->with('electricBills', $electricBills)->with('user', $user);
//     }
}
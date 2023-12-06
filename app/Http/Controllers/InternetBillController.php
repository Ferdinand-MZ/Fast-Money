<?php

namespace App\Http\Controllers;

use App\Models\InternetBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\User;

class InternetBillController extends Controller
{
    public function storeInternetBill(Request $request)
    {
        // Validate the form data
        $request->validate([
          'customer_id' => 'required|string|min:11|max:12',
          'nama_penyedia' => 'required|string',
          'harga' => 'required|numeric',
      ]);
  
      $user = Auth::user();
 
        if ($user->saldo >= $request->input('harga')) {
         // Create a new InternetBill instance and associate it with the user
         $internetBill = $user->internetBills()->create([
             'customer_id' => $request->input('customer_id'),
             'nama_penyedia' => $request->input('nama_penyedia'),
             'harga' => $request->input('harga'),
             'fullname' => $user->fullname,
             // Add any other fields as needed
         ]);

         $Log = Log::create([
            'id_user' => Auth::user()->id,
            'activity' => 'Anda Melakukan Transaksi Layanan Internet/Kabel TV'
        ]);
 
         // Deduct the balance from the user
         $user->saldo -= $internetBill->harga;
         $user->save();
 
         // Redirect back or to a specific route
         return redirect()->route('home')->with('success', 'Internet Bill added successfully');
     } else {
         // Redirect back with an error message if the user has insufficient balance
         return redirect()->route('home')->with('error', 'Insufficient balance to make the transaction');
     }
     
    }

    public function internetBill()
{
    // Retrieve the authenticated user
    $user = Auth::user();

    // Retrieve the electric bills associated with the user
    if ($user->role === 'admin') {
        // If the user is an admin, retrieve all electric bills
        $internetBills = InternetBill::all();
    } else {
        // If the user is not an admin, retrieve only the electric bills associated with the user
        $internetBills = $user->internetBills;
    }

    // Pass the electricBills variable to the view
    return view('pages.internetBill')->with('internetBills', $internetBills);
}

public function storeInternetBillForUser(Request $request)
{
    // Validasi input dari formulir
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'customer_id' => 'required|string|min:11|max:12',
        'nama_penyedia' => 'required|string',
        'harga' => 'required|numeric',
    ]);

    // Mendapatkan pengguna dari ID yang dipilih
    $user = User::findOrFail($request->input('user_id'));

    // Buat transaksi dan asosiasikan dengan pengguna yang dipilih
    $internetBill = $user->internetBills()->create([
        'customer_id' => $request->input('customer_id'),
        'nama_penyedia' => $request->input('nama_penyedia'),
        'harga' => $request->input('harga'),
        'fullname' => $user->fullname,
        // Tambahkan kolom lain sesuai kebutuhan
    ]);

    // Log transaksi
    $log = Log::create([
        'id_user' => Auth::id(),
        'activity' => 'Admin membuat transaksi Layanan Internet/Kabel TV untuk pengguna ' . $user->fullname,
    ]);

    // Redirect atau berikan respons sesuai kebutuhan
    return redirect()->route('home')->with('success', 'Transaksi Layanan Internet/Kabel TV berhasil ditambahkan untuk ' . $user->fullname);
}

public function showInternetBillsView()
{
    $vcari = request('search');
    $user = Auth::user();

    // Retrieve all users (you may want to use this data for something else)
    $users = User::all();

    // Check if a search query is present
    if ($vcari) {
        // If there is a search query, perform the search
        $internetBills = InternetBill::search($vcari)->paginate(10);
    } else {
        // If no search query, check if the user is an admin
        if ($user->role === 'admin') {
            // If the user is an admin, retrieve all electric bills
            $internetBills = InternetBill::paginate(10);
        } else {
            // If the user is not an admin, retrieve only the electric bills associated with the user
            $internetBills = $user->internetBills()->paginate(10);
        }
    }

    // Pass the electricBills and user variables to the view
    return view('pages.internetBill', compact('internetBills', 'vcari', 'user', 'users'));
}

public function destroy($id)
{
    InternetBill::where('id', $id)->delete();
    return redirect()->route('internetBill')->with('success', 'Data berhasil dihapus');
}

public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'customer_id' => 'required',
        'nama_penyedia' => 'required',
        'harga' => 'required',
    ]);

    // Use only the validated fields from the request
    $data = $request->only(['customer_id', 'nama_penyedia', 'harga']);

    // Update the record in the database
    InternetBill::where('id', $id)->update($data);

    // Redirect to the correct route
    return redirect()->route('internetBill')->with('success', 'Data berhasil diperbaharui');
}
}

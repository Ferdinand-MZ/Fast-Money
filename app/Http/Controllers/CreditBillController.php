<?php

namespace App\Http\Controllers;

use App\Models\CreditBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\User;

class CreditBillController extends Controller
{
    public function storeCreditBill(Request $request)
    {
        // Validate the form data
        $request->validate([
          'no_telp' => 'required|string|min:11|max:12',
          'provider' => 'required|string',
          'harga' => 'required|numeric',
      ]);
  
      $user = Auth::user();
 
        if ($user->saldo >= $request->input('harga')) {
         // Create a new ElectricBill instance and associate it with the user
         $creditBill = $user->creditBills()->create([
             'no_telp' => $request->input('no_telp'),
             'provider' => $request->input('provider'),
             'harga' => $request->input('harga'),
             'fullname' => $user->fullname,
             // Add any other fields as needed
         ]);

         $Log = Log::create([
            'id_user' => Auth::user()->id,
            'activity' => 'Anda Melakukan transaksi Pulsa'
        ]);
 
         // Deduct the balance from the user
         $user->saldo -= $creditBill->harga;
         $user->save();
 
         // Redirect back or to a specific route
         return redirect()->route('home')->with('success', 'Credit bill added successfully');
     } else {
         // Redirect back with an error message if the user has insufficient balance
         return redirect()->route('home')->with('error', 'Insufficient balance to make the transaction');
     }

     
    }

    public function storeCreditBillForUser(Request $request)
{
    // Validasi input dari formulir
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'no_telp' => 'required|string|min:11|max:12',
        'provider' => 'required|string',
        'harga' => 'required|numeric',
    ]);

    // Mendapatkan pengguna dari ID yang dipilih
    $user = User::findOrFail($request->input('user_id'));

    // Buat transaksi dan asosiasikan dengan pengguna yang dipilih
    $creditBill = $user->creditBills()->create([
        'no_telp' => $request->input('no_telp'),
        'provider' => $request->input('provider'),
        'harga' => $request->input('harga'),
        'fullname' => $user->fullname,
        // Tambahkan kolom lain sesuai kebutuhan
    ]);

    // Log transaksi
    $log = Log::create([
        'id_user' => Auth::id(),
        'activity' => 'Admin membuat transaksi Pulsa untuk pengguna ' . $user->fullname,
    ]);

    // Redirect atau berikan respons sesuai kebutuhan
    return redirect()->route('home')->with('success', 'Transaksi token listrik berhasil ditambahkan untuk ' . $user->fullname);
}

public function showCreditBillsView()
{
    $vcari = request('search');
    $user = Auth::user();

    // Retrieve all users (you may want to use this data for something else)
    $users = User::all();

    // Check if a search query is present
    if ($vcari) {
        // If there is a search query, perform the search
        $creditBills = CreditBill::search($vcari)->paginate(10);
    } else {
        // If no search query, check if the user is an admin
        if ($user->role === 'admin') {
            // If the user is an admin, retrieve all electric bills
            $creditBills = CreditBill::paginate(10);
        } else {
            // If the user is not an admin, retrieve only the electric bills associated with the user
            $creditBills = $user->creditBills()->paginate(10);
        }
    }

    // Pass the electricBills and user variables to the view
    return view('pages.creditBill', compact('creditBills', 'vcari', 'user', 'users'));
}

public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'no_telp' => 'required',
        'provider' => 'required',
        'harga' => 'required',
    ]);

    // Use only the validated fields from the request
    $data = $request->only(['no_telp', 'provider', 'harga']);

    // Update the record in the database
    CreditBill::where('id', $id)->update($data);

    // Redirect to the correct route
    return redirect()->route('creditBill')->with('success', 'Data berhasil diperbaharui');
}
    public function creditBill()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Retrieve the electric bills associated with the user
        if ($user->role === 'admin') {
        // If the user is an admin, retrieve all electric bills
        $creditBills = CreditBill::all();
    } else {
        // If the user is not an admin, retrieve only the electric bills associated with the user
        $creditBills = $user->creditBills;
    }

        // Pass the electricBills variable to the view
        return view('pages.creditBill')->with('creditBills', $creditBills);
    }

    public function create()
    {
        $creditBills = CreditBill::all();
        return view('pages.creditBill_create', compact('creditBills'));
    }


    public function destroy($id)
    {
        CreditBill::where('id', $id)->delete();
        return redirect()->route('creditBill')->with('success', 'Data berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'no_telp' => 'required|numeric', // Adjust validation rules as needed
            'saldo' => 'required|numeric|min:10000|max:500000',   // Adjust validation rules as needed
        ]);

        // Retrieve the user by phone number
        $user = User::where('no_telp', $request->no_telp)->first();

        if (!$user) {
            // Handle case when user is not found
            return back()->withErrors(['no_telp'=>'Nomer Telepon tidak ditemukan.']);
        }

        // Add the specified amount to the balance
        $user->saldo += $request->saldo;
        $user->save();

        $Log = Log::create([
            'id_user' => Auth::user()->id,
            'activity' => 'Anda Melakukan Pengisian saldo'
        ]);

        // Redirect with success message
        return redirect()->route('home')->with('success', 'Balance updated successfully.');
    
    }
}
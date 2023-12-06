<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::when(request('search'), function ($query, $search) {
            return $query->where('fullname', 'like', '%' . $search . '%')
                         ->orWhere('username', 'like', '%' . $search . '%');
        })
        ->paginate(10);
        
        $vcari = request('search');
        return view('pages.users', compact('users', 'vcari'));
    }

    public function create()
    {
        return view('pages.users');
    }

    public function store(Request $request)
    {
        // Validate unique email before creating a new user
        $request->validate([
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'required', // Ensure email is unique in the 'users' table
            'password' => 'required',
            'tgl_lahir' => 'required',
            'no_telp' => 'required',
        ]);
    
        // Create a new user using mass assignment
        $user = User::create([
            'username' => $request->input('username'),
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Make sure to hash the password
            'tgl_lahir' => $request->input('tgl_lahir'),
            'no_telp' => $request->input('no_telp'),
            // Add other fields as needed
        ]);
    
        return redirect()->route('users')->with('success', 'User created successfully.');
    }
    public function edit(User $users)
    {
        return view('pages.users', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required',
            'no_telp' => 'required',
            'saldo' => 'required',
        ]);

        $data = request()->except(['_token', '_method', 'submit']);

        User::where('id', $id)->update($data);
        return redirect()->route('users')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
{
    // Pastikan pengguna yang menghapus memiliki izin
    // Anda juga dapat menambahkan validasi lebih lanjut di sini

    $userToDelete = User::find($id);

    // Validasi apakah pengguna ditemukan
    if (!$userToDelete) {
        return redirect()->route('home')->with('error', 'Pengguna tidak ditemukan.');
    }

    // Handle related records in credit_bills, log, electric_bills, internet_bills tables
    $userToDelete->creditBills()->delete();
    $userToDelete->log()->delete();
    $userToDelete->electricBills()->delete();
    $userToDelete->internetBills()->delete();

    // Now, you can safely delete the user
    $userToDelete->delete();

    return redirect()->route('users')->with('success', 'Akun berhasil dihapus.');
}
}

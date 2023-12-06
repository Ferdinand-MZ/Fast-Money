<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin', [
            'title' => 'admin',
            'nasabah' => User::all()
        ]);
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
    
        return redirect()->route('admin')->with('success', 'Akun berhasil dihapus.');
    }
    // public function users()
    // {
    //     return view('pages.user', [
    //         'title' => 'user',
    //         'nasabah' => User::all()
    //     ]);
    // }
}

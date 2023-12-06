<?php

namespace App\Http\Controllers;

use App\Models\CreditBill;
use App\Models\InternetBill;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\ElectricBill;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SaldoController extends Controller
{
    public function kirim()
    {
        return view('saldo.kirim-saldo', [
            'title' => 'kirim'
        ]);
    }

    public function isi()
    {
        return view('saldo.isi-saldo', [
            'title' => 'isi'
        ]);
    }

    public function admin_saldo()
    {
        return view('saldo.admin-saldo', [
            'title' => 'admin-saldo'
        ]);
    }

    public function transaksi()
    {
        return view('saldo.transaksi-saldo', [
            'title' => 'isi'
        ]);
    }

    public function tokenlistrik()
    {
        return view('saldo.token-listrik', [
            'title' => 'listrik'
        ]);
    }

    public function bayarinternet()
    {
        return view('saldo.bayar-internet', [
            'title' => 'internet'
        ]);
    }

    public function belipulsa()
    {
        return view('saldo.beli-pulsa', [
            'title' => 'pulsa'
        ]);
    }

    public function log()
    {
        // Get the currently authenticated user
        $currentUser = auth()->user();
    
        // Modify the query to filter logs based on the user's ID
        if ($currentUser->role === 'admin') {
            // If the user is an admin, fetch all logs
            $log = Log::select('users.*', 'log.*')
                ->join('users', 'users.id', '=', 'log.id_user')
                ->orderBy('log.id', 'desc')
                ->get();
        } else {
            // If the user is not an admin, fetch only their own logs
            $log = Log::select('users.*', 'log.*')
                ->join('users', 'users.id', '=', 'log.id_user')
                ->where('log.id_user', '=', $currentUser->id)
                ->orderBy('log.id', 'desc')
                ->get();
        }
    
        // Pass the filtered logs to the view
        return view('pages.log', [
            'title' => 'log',
            'log' => $log,
        ]);
    }
    public function electricBillCreate()
    {
        return view('pages.electricBill_create', [
            'title' => 'electricBill'
        ]);
    }
}
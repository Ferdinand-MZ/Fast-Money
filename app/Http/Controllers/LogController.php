<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $log = Log::select('users.*', 'log.*')
        ->join('users', 'users.id', '=', 'log.id_user')
        ->orderBy('log.id', 'desc') // Add this line to order by the 'id' column
        ->get();
        return view('log', compact('log'));
    }
}

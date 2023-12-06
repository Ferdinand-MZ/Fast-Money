<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $currentUser = auth()->user();

        $log = Log::select('users.*', 'log.*')
        ->join('users', 'users.id', '=', 'log.id_user')
        ->where('log.id_user', '=', $currentUser->id)
        ->orderBy('log.id', 'desc') // Add this line to order by the 'id' column
        ->get();
        

        return view('pages.billing', [
            'title' => 'billing',
            'log' => $log,
        ]);
    }

    public function log()
    {
        return view('pages.log');
    }

   
}

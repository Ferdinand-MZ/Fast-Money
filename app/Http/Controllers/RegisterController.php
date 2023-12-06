<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register', [
            'title' => 'register'
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'fullname' => 'required|max:255|min:2',
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'tgl_lahir' => 'required',
            'no_telp' => 'required|min:10|max:15',
            'terms' => 'required'
        ]);
        $user = User::create($attributes);
        auth()->login($user);

        return redirect('/dashboard');
    }
}

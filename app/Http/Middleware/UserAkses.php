<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ... $role)
{
    // Check if the user is authenticated
    if (auth()->check()) {
        // Check if the user has the required role
        if (in_array(auth()->user()->role, $role)) {
            return $next($request);
        }
    }

    // If the user is not authenticated or doesn't have the required role, return an error response
    return response()->json(['Anda Tidak Diperbolehkan Masuk Ke Halaman Ini']);
}

}
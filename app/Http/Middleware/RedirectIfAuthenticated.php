<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // Pengguna sudah terautentikasi, arahkan ke halaman utama aplikasi
            return redirect('/home'); // Ganti '/home' dengan route yang sesuai
        }

        return $next($request);
    }
}

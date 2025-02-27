<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Jika user sudah login, redirect ke halaman utama
        if (Auth::check()) {
            return redirect('/home'); 
        }

        return $next($request);
    }
}

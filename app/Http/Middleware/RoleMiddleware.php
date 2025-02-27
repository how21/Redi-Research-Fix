<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles) // Gunakan spread operator
    {
        if (!Auth::check()) {
            return redirect('/login'); // Redirect jika belum login
        }

        // Cek apakah role user ada dalam daftar role yang diperbolehkan
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized'); // Akses ditolak jika role tidak sesuai
        }

        return $next($request);
    }
}

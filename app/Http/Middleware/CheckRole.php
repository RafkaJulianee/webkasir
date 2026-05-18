<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role_id): Response
    {
        // Pastikan user sudah login dan role_id nya sesuai
        if (Auth::check() && Auth::user()->role_id == $role_id) {
            return $next($request);
        }

        // Jika tidak berhak, tampilkan error 403 (Forbidden)
        abort(403, 'Maaf, Anda tidak memiliki hak akses untuk halaman ini.');
    }
}
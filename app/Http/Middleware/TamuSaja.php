<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TamuSaja
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kalau sudah login, tidak perlu lihat halaman login lagi
        if (session()->has('login_role')) {
            if (session('login_role') === 'admin') {
                return redirect()->route('admin.artikel.index');
            }
            return redirect()->route('beranda');
        }

        return $next($request);
    }
}
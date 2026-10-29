<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session('login_role') !== 'user') {
            return redirect('/login')->with('error', 'Silakan login sebagai pengguna dulu.');
        }

        return $next($request);
    }
}
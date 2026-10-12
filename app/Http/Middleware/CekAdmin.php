<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session('login_role') !== 'admin') {
            return redirect('/login')->with('error', 'Silakan login sebagai admin dulu.');
        }

        return $next($request);
    }
}
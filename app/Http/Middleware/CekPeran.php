<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekPeran
{
    public function handle(Request $request, Closure $next, string $peran): Response
    {
        // 1. Authentication: sudah login atau belum?
        if (! session()->has('login_role')) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        // 2. Authorization: perannya boleh masuk atau tidak?
        if (session('login_role') !== $peran) {
            abort(403);
        }

        return $next($request);
    }
}
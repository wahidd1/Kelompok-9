<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter; use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required|in:user,admin',
    ]);

    // Pembatasan login berdasarkan email dan IP
    $kunci = Str::lower($credentials['email']) . '|' . $request->ip();

    // Cek batas percobaan login
    if (RateLimiter::tooManyAttempts($kunci, 5)) {
        $detik = RateLimiter::availableIn($kunci);

        return back()
            ->withErrors([
                'email' => 'Terlalu banyak percobaan. Coba lagi dalam ' . $detik . ' detik.'
            ])
            ->onlyInput('email');
    }

    // Cari akun berdasarkan role
    if ($credentials['role'] === 'admin') {
        $akun = Admin::where('email', $credentials['email'])->first();
    } else {
        $akun = Pengguna::where('email', $credentials['email'])->first();
    }

    // Validasi akun dan password
    if (!$akun || !Hash::check($credentials['password'], $akun->password)) {

        RateLimiter::hit($kunci, 60);

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.'
            ])
            ->onlyInput('email');
    }

    // Reset percobaan login
    RateLimiter::clear($kunci);

    // Regenerate session
    $request->session()->regenerate();

    session([
        'login_role' => $credentials['role'],
        'login_id' => $credentials['role'] === 'admin'
            ? $akun->id_admin
            : $akun->id_pengguna,
        'login_name' => $akun->username,
    ]);

    // Redirect berdasarkan role
    if ($credentials['role'] === 'admin') {
        return redirect()->route('admin.artikel.index');
    }

    return redirect()->route('beranda');
}

    public function destroy(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Kamu sudah logout.');
    }
}
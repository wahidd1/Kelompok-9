<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
public function create()
{
return view('auth.register');
}
public function store(Request $request)
{
$validated = $request->validate([
    'username' => 'required|string|max:50',
    'email' => 'required|email|unique:pengguna,email',
    'password' => [
        'required',
        'min:8',
        'confirmed',
        'regex:/[A-Za-z]/',
        'regex:/[0-9]/',
    ],
    'gender' => 'required|in:laki-laki,perempuan',
    'umur' => 'required|integer|min:1',
], [
    'password.min' => 'Password minimal 8 karakter.',
    'password.confirmed' => 'Konfirmasi password tidak sama.',
    'password.regex' => 'Password harus mengandung huruf dan angka.',
]);
    Pengguna::create([
        'username' => $validated['username'],
        'email'    => $validated['email'],
        'password' => Hash::make($validated['password']),
        'gender'   => $validated['gender'],
        'umur'     => $validated['umur'],
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
}
}
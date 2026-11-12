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
'password' => 'required|min:8',
'gender' => 'required|in:laki-laki,perempuan',
'umur' => 'required|integer|min:1',
]);
Pengguna::create([
'username' => $validated['username'],
'email' => $validated['email'],
'password' => Hash::make($validated['password']),
'gender' => $validated['gender'],
'umur' => $validated['umur'],
'tanggal_daftar' => now(),
]);
return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan masuk.');
}
}


<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
if ($credentials['role'] === 'admin') {
$akun = Admin::where('email', $credentials['email'])->first();
} else {
$akun = Pengguna::where('email', $credentials['email'])->first();
}
if (! $akun || ! Hash::check($credentials['password'], $akun->password)) {
return back()
->withErrors(['email' => 'Email atau password salah.'])
->onlyInput('email');
}
session([
'login_role' => $credentials['role'],
'login_id' => $credentials['role'] === 'admin' ? $akun->id_admin : $akun->id_pengguna,
'login_name' => $akun->username,
]);
return redirect('/dashboard');
}
}

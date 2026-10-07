<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
// Buat user (publik)
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
// Buat admin (wajib login admin, dijaga middleware cekadmin)
Route::middleware('cekadmin')->prefix('admin')->group(function () {
Route::get('/artikel', [AdminArtikelController::class, 'index'])->name('admin.artikel.index');
Route::get('/artikel/tambah', [AdminArtikelController::class, 'create'])->name('admin.artikel.create');
Route::post('/artikel', [AdminArtikelController::class, 'store'])->name('admin.artikel.store');
Route::delete('/artikel/{id}', [AdminArtikelController::class, 'destroy'])->name('admin.artikel.destroy');
});

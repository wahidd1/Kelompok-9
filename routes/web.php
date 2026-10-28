<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\HasilKuisController;
use App\Http\Controllers\Admin\KuisController as AdminKuisController;

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('beranda');
// Buat user (publik)
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
// Buat admin (wajib login admin, dijaga middleware cekadmin)
Route::middleware('cekadmin')->prefix('admin')->group(function () {
Route::get('/artikel', [AdminArtikelController::class, 'index'])->name('admin.artikel.index');
Route::get('/artikel/tambah', [AdminArtikelController::class, 'create'])->name('admin.artikel.create');
Route::post('/artikel', [AdminArtikelController::class, 'store'])->name('admin.artikel.store');
Route::delete('/artikel/{id}', [AdminArtikelController::class, 'destroy'])->name('admin.artikel.destroy');
Route::get('/kuis', [AdminKuisController::class, 'index'])->name('admin.kuis.index');
Route::post('/kuis', [AdminKuisController::class, 'store'])->name('admin.kuis.store');
Route::delete('/kuis/{id}', [AdminKuisController::class, 'destroy'])->name('admin.kuis.destroy');
});
Route::middleware('cekuser')->group(function () {
    Route::get('/kuis', [KuisController::class, 'index'])->name('kuis.index');
    Route::get('/kuis/{id}', [KuisController::class, 'show'])->name('kuis.show');
    Route::post('/kuis/{id}', [KuisController::class, 'submit'])->name('kuis.submit');
    Route::get('/hasil', [HasilKuisController::class, 'index'])->name('hasil.index');
    Route::get('/hasil/{id}', [HasilKuisController::class, 'show'])->name('hasil.show');
});
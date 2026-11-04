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

// ==========================================
// ⚠️ ROUTE DUMMY MODUL 4 (LENGKAP)
// Hapus kode ini kalau backend asli udah di-merge!
// ==========================================

// 1. Route buat Form Feedback di halaman Artikel
Route::post('/feedback', function () { 
    return back()->with('success', 'Feedback berhasil dikirim (Dummy)!'); 
})->name('feedback.store');

// 2. Route buat Admin
Route::middleware('cekadmin')->prefix('admin')->group(function () {
    
    // Halaman Tabel Feedback
    Route::get('/feedback', function () { 
        // Bikin data palsu (dummy) 2 baris
        $feedback = new \Illuminate\Pagination\LengthAwarePaginator(
            collect([
                (object)['id_feedback'=>1, 'pengguna'=>(object)['username'=>'minji'], 'isi_feedback'=>'Webnya keren banget, lanjutkan!', 'tanggal'=>'2026-11-04'],
                (object)['id_feedback'=>2, 'pengguna'=>(object)['username'=>'budi'], 'isi_feedback'=>'Kuisnya seru, tapi tolong tambah soalnya.', 'tanggal'=>'2026-11-04']
            ]), 2, 10, 1
        );
        return view('admin.feedback.index', compact('feedback')); 
    })->name('admin.feedback.index');
    
    // Tombol Setujui & Hapus di Tabel Feedback
    Route::put('/feedback/{id}/approve', function() { return back()->with('success', 'Feedback disetujui (Dummy).'); })->name('admin.feedback.approve');
    Route::delete('/feedback/{id}', function() { return back()->with('success', 'Feedback dihapus (Dummy).'); })->name('admin.feedback.destroy');

    // Halaman Laporan (3 Tab)
    Route::get('/laporan', function () { 
        // Data palsu buat Tab 1 (Pengguna)
        $pengguna = collect([ 
            (object)['id_pengguna'=>1, 'username'=>'minji', 'email'=>'minji@mail.com', 'gender'=>'perempuan', 'umur'=>20],
            (object)['id_pengguna'=>2, 'username'=>'budi', 'email'=>'budi@mail.com', 'gender'=>'laki-laki', 'umur'=>22]
        ]);
        // Data palsu buat Tab 2 (Hasil Kuis)
        $hasil_kuis = collect([ 
            (object)['id'=>1, 'id_pengguna'=>1, 'skor'=>100, 'tanggal'=>'2026-11-04'] 
        ]);
        // Data palsu buat Tab 3 (Feedback)
        $feedback = collect([ 
            (object)['id_feedback'=>1, 'pengguna'=>(object)['username'=>'minji'], 'isi_feedback'=>'Mantap!', 'tanggal'=>'2026-11-04'] 
        ]);
        
        return view('admin.laporan.index', compact('pengguna', 'hasil_kuis', 'feedback')); 
    })->name('admin.laporan.index');

    // Tombol Cetak PDF
    Route::get('/laporan/export', function () { 
        return back()->with('success', 'Fitur Cetak PDF jalan (Dummy).'); 
    })->name('admin.laporan.export');

});
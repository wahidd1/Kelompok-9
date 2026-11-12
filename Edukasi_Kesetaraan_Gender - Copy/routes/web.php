<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; // Wajib ditambahkan di Laravel 11
use App\Http\Controllers\ShuttleController;

Route::resource('shuttles', ShuttleController::class);
Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/service', [PageController::class, 'service']);
Route::get('/shuttle/export-pdf', [ShuttleController::class, 'exportPdf']);
Route::get('/export-pdf', [ShuttleController::class, 'exportPdf'])->name('export.pdf');
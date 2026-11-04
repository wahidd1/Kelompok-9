<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Models\HasilKuis;
use App\Models\Pengguna;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
{
    return view('admin.laporan.index', [
        'pengguna'  => Pengguna::all(),
        'hasilKuis' => HasilKuis::all(),
        'feedback'  => Feedback::all(),
    ]);
}

public function export()
{
    $pdf = Pdf::loadView('admin.laporan.pdf', [
        'pengguna'  => Pengguna::all(),
        'hasilKuis' => HasilKuis::all(),
        'feedback'  => Feedback::all(),
    ]);

    return $pdf->download('laporan.pdf');
}
}

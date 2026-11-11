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
    private function ringkasan()
    {
        return [
            'total_pengguna'   => Pengguna::count(),
            'total_pengerjaan' => HasilKuis::count(),
            'rata_skor'        => round(HasilKuis::avg('skor') ?? 0),
            'total_feedback'   => Feedback::count(),
        ];
    }

    public function index()
    {
        return view('admin.laporan.index', [
            'ringkasan' => $this->ringkasan(),
            'pengguna'  => Pengguna::latest('id_pengguna')->take(10)->get(),
            'hasilKuis' => HasilKuis::with(['pengguna', 'kuis'])->latest('tanggal')->take(10)->get(),
            'feedback'  => Feedback::with('pengguna')->latest('tanggal')->take(10)->get(),
        ]);
    }

    public function export()
    {
        $pdf = Pdf::loadView('admin.laporan.pdf', [
            'ringkasan' => $this->ringkasan(),
            'pengguna'  => Pengguna::orderBy('id_pengguna')->get(),
            'hasilKuis' => HasilKuis::with(['pengguna', 'kuis'])->orderByDesc('tanggal')->get(),
            'feedback'  => Feedback::with('pengguna')->orderByDesc('tanggal')->get(),
        ]);

        return $pdf->download('laporan.pdf');
    }
}
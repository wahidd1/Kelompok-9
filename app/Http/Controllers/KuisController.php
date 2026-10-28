<?php

namespace App\Http\Controllers;

use App\Models\HasilKuis;
use App\Models\Kuis;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::withCount('pertanyaan')->orderByDesc('tanggal')->get();

        return view('kuis.index', compact('kuis'));
    }

    public function show($id)
    {
        $kuis = Kuis::with('pertanyaan.pilihan')->findOrFail($id);

        return view('kuis.show', compact('kuis'));
    }

    public function submit(Request $request, $id)
    {
        $kuis = Kuis::with('pertanyaan.pilihan')->findOrFail($id);

        abort_if($kuis->pertanyaan->isEmpty(), 404);

        // Setiap soal wajib ada jawaban sebelum submit boleh diproses
        $aturan = [];
        foreach ($kuis->pertanyaan as $soal) {
            $aturan['jawaban.' . $soal->id_pertanyaan] = 'required|integer';
        }
        $request->validate($aturan, ['required' => 'Semua soal harus dijawab.']);

        // Controller TIDAK menghitung skor sendiri, itu tugas Model
        $hasil = HasilKuis::simpanDariJawaban(
            session('login_id'),
            $kuis,
            $request->input('jawaban', [])
        );

        return redirect()->route('hasil.show', $hasil->id_hasil);
    }
}
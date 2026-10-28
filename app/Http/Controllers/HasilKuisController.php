<?php

namespace App\Http\Controllers;

use App\Models\HasilKuis;

class HasilKuisController extends Controller
{
    public function index()
    {
        $hasil = HasilKuis::with('kuis')
            ->where('id_pengguna', session('login_id'))
            ->orderByDesc('id_hasil')
            ->get();

        return view('hasil.index', compact('hasil'));
    }

    public function show($id)
    {
        // where id_pengguna: user A nggak bisa membuka hasil kuis milik user B
        $hasil = HasilKuis::with(['kuis', 'jawaban.pertanyaan.pilihan', 'jawaban.pilihan'])
            ->where('id_pengguna', session('login_id'))
            ->findOrFail($id);

        return view('hasil.show', compact('hasil'));
    }
}
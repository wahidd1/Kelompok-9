<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::withCount('pertanyaan')->orderByDesc('tanggal')->get();

        return view('admin.kuis.index', compact('kuis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'soal' => 'required|array|min:1',
            'soal.*.pertanyaan' => 'required|string',
            'soal.*.opsi' => 'required|array|size:4',
            'soal.*.opsi.*' => 'required|string|max:255',
            'soal.*.benar' => 'required|integer|between:0,3',
        ], [
            'soal.required' => 'Minimal harus ada 1 soal.',
            'soal.*.pertanyaan.required' => 'Pertanyaan setiap soal wajib diisi.',
            'soal.*.opsi.size' => 'Setiap soal harus punya 4 pilihan jawaban.',
            'soal.*.opsi.*.required' => 'Semua pilihan jawaban (A-D) wajib diisi.',
            'soal.*.benar.required' => 'Tentukan jawaban yang benar untuk setiap soal.',
        ]);

        Kuis::buatLengkap($validated, session('login_id'));

        return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Kuis::findOrFail($id)->delete();

        return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil dihapus.');
    }
}
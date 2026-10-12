<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::orderByDesc('tanggalPublish')->get();

        return view('admin.artikel.index', compact('artikel'));
    }

    public function create()
    {
        return view('admin.artikel.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'sumber' => 'nullable|string|max:255',
        ]);

                Artikel::create([
            'id_admin'        => session('login_id'),
            'judul'           => $validated['judul'],
            'konten'          => $validated['konten'],
            'tanggalPublish'  => now(),
            'sumber'          => $validated['sumber'] ?? null,
        ]);

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Artikel::findOrFail($id)->delete();

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil dihapus.');
    }
}
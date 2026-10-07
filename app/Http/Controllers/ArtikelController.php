<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::orderByDesc('tanggalPublish')->get();

        return view('artikel.index', compact('artikel'));
    }

    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);

        return view('artikel.show', compact('artikel'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Shuttle;
use Illuminate\Http\Request;

class ShuttleController extends Controller
{
    // READ + FILTERING
    public function index(Request $request)
    {
        $shuttles = Shuttle::when($request->search, function ($query, $search) {
            return $query->where('nama_armada', 'like', "%{$search}%");
        })->get();

        return view('shuttles.index', compact('shuttles'));
    }

    // CREATE: tampilkan form
    public function create()
    {
        return view('shuttles.create');
    }

    // CREATE: simpan data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_armada'      => 'required|string|max:255',
            'kapasitas'        => 'required|integer|min:1',
            'rute_operasional' => 'nullable|string|max:255',
            'status_aktif'     => 'required|boolean',
        ]);

        Shuttle::create($validated);

        return redirect()->route('shuttles.index')
            ->with('success', 'Data armada berhasil ditambahkan.');
    }

    // SHOW: detail satu data
    public function show(string $id)
    {
        $shuttle = Shuttle::findOrFail($id);
        return view('shuttles.show', compact('shuttle'));
    }

    // UPDATE: tampilkan form edit
    public function edit(string $id)
    {
        $shuttle = Shuttle::findOrFail($id);
        return view('shuttles.edit', compact('shuttle'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_armada'      => 'required|string|max:255',
            'kapasitas'        => 'required|integer|min:1',
            'rute_operasional' => 'nullable|string|max:255',
            'status_aktif'     => 'required|boolean',
        ]);

        $shuttle = Shuttle::findOrFail($id);
        $shuttle->update($validated);

        return redirect()->route('shuttles.index')
            ->with('success', 'Data armada berhasil diperbarui.');
    }

    // DELETE
    public function destroy(string $id)
    {
        $shuttle = Shuttle::findOrFail($id);
        $shuttle->delete();

        return redirect()->route('shuttles.index')
            ->with('success', 'Data armada berhasil dihapus.');
    }
}
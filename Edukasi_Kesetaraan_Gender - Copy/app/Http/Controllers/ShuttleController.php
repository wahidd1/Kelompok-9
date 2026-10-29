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
            'nama_armada' => 'required|string|max:50',
            'kapasitas' => 'required|numeric|min:10|max:60',
            'rute_operasional' => 'required|string'
        ]);

        Shuttle::create($validated);

        return redirect()->route('shuttles.index');
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
            'nama_armada' => 'required|string|max:50',
            'kapasitas' => 'required|numeric|min:10|max:60',
            'rute_operasional' => 'required|string'
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
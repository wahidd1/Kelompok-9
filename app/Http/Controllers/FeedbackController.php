<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller 

{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'isi_feedback' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'id_pengguna'  => session('login_id'),
            'isi_feedback' => $validated['isi_feedback'],
            'tanggal'      => now(),
        ]);

        return back()->with('success', 'Feedback terkirim.');
    }
}
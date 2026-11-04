<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
{
    $feedback = Feedback::with('pengguna')->orderByDesc('tanggal')->get();
    return view('admin.feedback.index', compact('feedback'));
}

public function approve($id)
{
    Feedback::findOrFail($id)->update(['id_admin' => session('login_id')]);
    return redirect('/admin/feedback')->with('success', 'Feedback disetujui.');
}

public function destroy($id)
{
    Feedback::findOrFail($id)->delete();
    return redirect('/admin/feedback')->with('success', 'Feedback dihapus.');
}

}

<div class="card mt-5 shadow-sm">
    <div class="card-header bg-primary text-white">
        Kirim Masukan / Feedback
    </div>
    <div class="card-body">
        {{-- Tampilkan pesan sukses kalau ada --}}
        
        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Masukan Anda</label>
                <textarea name="isi_feedback" rows="4" class="form-control" placeholder="Tulis masukan, saran, atau kritik Anda di sini..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Feedback</button>
        </form>
    </div>
</div>
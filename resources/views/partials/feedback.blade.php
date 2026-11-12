<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-chat-heart me-1"></i> Kirim Masukan / Feedback
    </div>
    <div class="card-body">
        {{-- F8d: Cek apakah yang login adalah user --}}
        @if (session('login_role') === 'user')
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Masukan Anda</label>
                    <textarea name="isi_feedback" rows="4" class="form-control @error('isi_feedback') is-invalid @enderror" placeholder="Tulis masukan, saran, atau kritik Anda di sini..." required>{{ old('isi_feedback') }}</textarea>
                    @error('isi_feedback')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Kirim Feedback</button>
            </form>
        @else
            <p class="mb-0 text-muted">Silakan <a href="{{ route('login') }}">login sebagai pengguna</a> untuk mengirim feedback.</p>
        @endif
    </div>
</div>
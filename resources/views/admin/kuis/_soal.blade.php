<div class="border rounded p-3 mb-3 blok-soal">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <b>Soal</b>
        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-soal">Hapus soal</button>
    </div>
    
    <div class="mb-2">
        <label class="form-label">Pertanyaan</label>
        <textarea name="soal[{{ $i }}][pertanyaan]" rows="2" class="form-control" required></textarea>
    </div>
    
    @foreach (['A', 'B', 'C', 'D'] as $j => $huruf)
        <div class="input-group mb-2">
            <span class="input-group-text">
                <input type="radio" name="soal[{{ $i }}][benar]" value="{{ $j }}" class="form-check-input mt-0" title="Tandai sebagai jawaban benar" @if ($j === 0) checked @endif>
            </span>
            <span class="input-group-text">{{ $huruf }}</span>
            <input type="text" name="soal[{{ $i }}][opsi][{{ $j }}]" class="form-control" placeholder="Pilihan {{ $huruf }}" required>
        </div>
    @endforeach
    
    <small class="text-muted">Pilih bulatan di sebelah kiri pada jawaban yang benar.</small>
</div>
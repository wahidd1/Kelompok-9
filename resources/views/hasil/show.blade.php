@extends('layouts.app')

@section('title', 'Hasil Kuis')

@section('content')
    <h2 class="mb-3">{{ $hasil->kuis->judul }}</h2>

    <div class="card text-center p-3 mb-4">
        <div>Skor</div>
        <div class="display-4">{{ $hasil->skor }}</div>
        <small class="text-muted">{{ $hasil->skor_benar }} benar, {{ $hasil->skor_salah }} salah</small>
    </div>

    <h4 class="mb-3">Hasil dan Pembahasan</h4>

    @foreach ($hasil->jawaban as $no => $item)
        <div class="card p-3 mb-2">
            <p class="mb-1">
            <b>{{ $no + 1 }}. {{ $item->pertanyaan->pertanyaan }}</b></p>
            <p class="mb-1">
                Jawabanmu: {{ $item->pilihan->opsi }}
                @if ($item->pilihan->is_benar)
                    <span class="badge bg-success">Benar</span>
                @else
                    <span class="badge bg-danger">Salah</span>
                @endif
            </p>
            
            @unless ($item->pilihan->is_benar)
                <p class="mb-0 text-muted">
                Jawaban yang benar: {{ $item->pertanyaan->pilihan->firstWhere('is_benar', true)?->opsi }}
                </p>
            @endunless
        </div>
    @endforeach

    <div class="mt-3">
        <a href="{{ route('kuis.show', $hasil->id_kuis) }}" class="btn btn-danger">Ulangi Kuis</a>
        <a href="{{ route('hasil.index') }}" class="btn btn-outline-secondary">Kembali ke Daftar Hasil</a>
    </div>
@endsection
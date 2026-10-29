@extends('layouts.app')

@section('title', 'Hasil Kuis')

@section('content')
    <h2 class="mb-4">Hasil Kuis Yang Sudah Kamu Kerjakan</h2>

    @forelse ($hasil as $item)
        <div class="card mb-2 p-3 d-flex flex-row justify-content-between align-items-center">
            <div>
                <b>{{ $item->kuis->judul }}</b><br>
                <small class="text-muted">
                    Skor {{ $item->skor }} · {{ $item->skor_benar }} benar, {{ $item->skor_salah }} salah
                    · {{ $item->tanggal->format('d M Y H:i') }}
                </small>
            </div>
            <a href="{{ route('hasil.show', $item->id_hasil) }}" class="btn btn-primary btn-sm">Lihat Pembahasan</a>
        </div>
    @empty
        <p>Belum ada hasil kuis. <a href="{{ route('kuis.index') }}">Kerjakan kuis dulu</a>.</p>
    @endforelse

@endsection
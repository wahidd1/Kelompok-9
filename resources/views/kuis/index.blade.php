@extends('layouts.app')

@section('title', 'Kuis')

@section('content')
<h2 class="mb-2">Siap Menguji Pengetahuan</h2>
<p class="text-muted mb-4">Kerjakan kuis yang tersedia dan lihat seberapa baik kamu memahami materi yang telah dipelajari.</p>

@forelse ($kuis as $item)
    <div class="card card-hover mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
        <div>
            <b>{{ $item->judul }}</b><br>
            {{-- F8e: Benerin typo dan tampilkan jumlah soal --}}
            <small class="text-muted">{{ $item->pertanyaan_count }} soal</small>
            @if ($item->deskripsi)
                <br><span class="text-muted small">{{ $item->deskripsi }}</span>
            @endif
        </div>
        @if ($item->pertanyaan_count > 0)
            <a href="{{ route('kuis.show', $item->id_kuis) }}" class="btn btn-primary">Mulai</a>
        @endif
    </div>
@empty
    <div class="alert alert-light text-center">Belum ada kuis yang tersedia.</div>
@endforelse
@endsection
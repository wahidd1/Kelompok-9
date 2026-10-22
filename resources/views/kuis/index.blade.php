@extends('layouts.app')

@section('title', 'Kuis')

@section('content')
    <h2 class="mb-2">Siap Menguji Pengetahuanmu</h2>
    <p class="mb-4">Kerjakan	kuis	yang	tersedia	dan	lihat	seberapa	baik	kamu	memahami	materi	yang	telah dipelajari.</p>

    @forelse ($kuis as $item)
        <div class="card mb-2 	p-3	d-flex flex-row  justify-content-between	align-items-center">
            <div>
                <b>{{ $item->judul }}</b><br>
                <small class="text-muted">{{ $item->pertanyaan_count }}</small>
                @if ($item->deskripsi)
                    <br>{{ $item->deskripsi }}
                @endif
            </div>
            
            @if ($item->pertanyaan_count > 0)
                <a href="{{ route('kuis.show', $item->id_kuis) }}" class="btn btn-primary">Mulai</a>
            @endif
        </div>
    @empty
        <p>Belum ada kuis yang tersediaaaa.</p>
    @endforelse
@endsection
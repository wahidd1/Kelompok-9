@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
    <h2 class="mb-4">Belajar Melalui Artikel Edukatif</h2>

    <div class="row g-4">
        @forelse ($artikel as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover h-100">
                    <div class="card-body d-flex flex-column"> 
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($item->konten, 100) }}</p>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-calendar3 me-1"></i>{{ $item->tanggalPublish->format('d M Y') }}
                        </p>
                        <a href="{{ route('artikel.show', $item->id_artikel) }}" class="btn btn-sm btn-primary align-self-start">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center">Belum ada artikel yang tersedia.</div> 
            </div>
        @endforelse
    </div>
@endsection
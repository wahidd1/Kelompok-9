@extends('layouts.app')
@section('title', 'Artikel')

@section('content')
    <h2 class="mb-4">Belajar Melalui Artikel Edukatif</h2>
    <div class="row">
        @foreach ($artikels as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column"> 
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($item->konten, 80) }}</p>
                        <p	class="text-muted	small	mb-2">{{	$item->tanggalPublish->format('d	M	Y')	}}</p>
                        <a href="{{ route('artikel.show', $item->id_artikel) }}" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @empty
                <p>Belum ada artikel yang tersedia.</p>
        @endforeach
    </div>
    @endsection
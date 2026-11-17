@extends('layouts.app')

@section('title', 'Kelola Artikel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Kelola Artikel</h2>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah
    </a>
</div>

@forelse ($artikel as $item)
    <div class="card card-hover mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
        <div>
            <b>{{ $item->judul }}</b><br>
            <small class="text-muted">{{ $item->tanggalPublish->format('d M Y') }}</small>
        </div>
        
        <div class="d-flex gap-2">
            {{-- TOMBOL EDIT BARU --}}
            <a href="{{ route('admin.artikel.edit', $item->id_artikel) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            
            {{-- TOMBOL HAPUS --}}
            <form action="{{ route('admin.artikel.destroy', $item->id_artikel) }}" method="POST" onsubmit="return confirm('Yakin mau hapus artikel ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </div>
    </div>
@empty
    <div class="alert alert-light text-center">Belum ada artikel.</div>
@endforelse
@endsection
@extends('layouts.app')

@section('title', isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel')

@section('content')
<h2 class="mb-4">{{ isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel' }}</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card p-4">
    <form action="{{ isset($artikel) ? route('admin.artikel.update', $artikel->id_artikel) : route('admin.artikel.store') }}" method="POST">
        @csrf
        @if (isset($artikel))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $artikel->judul ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="konten" rows="8" class="form-control" required>{{ old('konten', $artikel->konten ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Sumber</label>
            <input type="text" name="sumber" class="form-control" value="{{ old('sumber', $artikel->sumber ?? '') }}">
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
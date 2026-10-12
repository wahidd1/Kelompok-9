@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<h2 class="mb-4">Form Artikel</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.artikel.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Konten</label>
        <textarea name="konten" rows="6" class="form-control">{{ old('konten') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Sumber</label>
        <input type="text" name="sumber" class="form-control" value="{{ old('sumber') }}">
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Simpan</button> 
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">Batal</a>  
    </div>
</form>
@endsection
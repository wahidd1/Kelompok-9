@extends('layouts.app')

@section('title', 'Edit Kuis')

@section('content')
<h2 class="mb-4">Edit Kuis</h2>

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
    <form action="{{ route('admin.kuis.update', $kuis->id_kuis) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Kuis</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $kuis->judul) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi (opsional)</label>
            <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $kuis->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $kuis->tanggal->format('Y-m-d')) }}" required>
        </div>

        <div class="alert alert-info">
            <i class="bi bi-info-circle me-1"></i> Soal dan pilihan jawaban tidak bisa diubah di sini. Kalau soalnya perlu diganti, hapus kuis ini lalu buat yang baru.
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.kuis.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
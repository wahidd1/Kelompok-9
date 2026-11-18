@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-1 fw-bold">403</h1>
        <h4 class="mb-3">Akses Ditolak</h4>
        <p class="text-muted">Kamu tidak punya izin untuk membuka halaman ini.</p>
        <a href="{{ route('beranda') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
@endsection
@extends('layouts.app')

@section('title', $artikel->judul)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card p-4">
            <h2>{{ $artikel->judul }}</h2>
            <p class="text-muted">
                <i class="bi bi-calendar3 me-1"></i>{{ $artikel->tanggalPublish->format('d M Y') }}
                @if ($artikel->sumber)
                    &middot; Sumber: {{ $artikel->sumber }}
                @endif
            </p>
            <hr>
            <div style="line-height: 1.8;">{!! nl2br(e($artikel->konten)) !!}</div>
        </div>
        <a href="{{ route('artikel.index') }}" class="btn btn-outline-primary mt-4">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Artikel
        </a>
        
        {{-- Panggil form feedback --}}
        @include('partials.feedback')
    </div>
</div>
@endsection
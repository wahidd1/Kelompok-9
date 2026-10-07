@extends('layouts.app')
@section('title', $artikel->judul)

@section('content')
<h2>{{ $artikel->judul }}</h2>

<p class="text-muted">
    {{ $artikel->tanggalPublish->format('d M Y') }}
    @if ($artikel->sumber)
        &middot; Sumber: {{ $artikel->sumber }}
    @endif
</p>

<div>{!! nl2br(e($artikel->konten)) !!}</div>

<a href="{{ route('artikel.index') }}" class="btn btn-secondary mt-4">Kembali ke Daftar Artikel</a>  
@endsection
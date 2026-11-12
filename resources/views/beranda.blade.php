@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="hero text-center text-white mb-5">
    <h1 class="fw-semibold mb-3 text-white">Pahami apa itu Kesetaraan Gender</h1>
    <p class="lead mb-4">Temukan artikel edukatif, tingkatkan pemahaman, dan uji pengetahuan melalui kuis interaktif.</p>
    
    @if (session('login_role'))
        <a href="{{ route('artikel.index') }}" class="btn btn-light btn-lg">Baca Artikel</a>
        @if (session('login_role') === 'user')
            <a href="{{ route('kuis.index') }}" class="btn btn-outline-light btn-lg">Kerjakan Kuis</a>
        @endif
    @else
        <a href="{{ route('register') }}" class="btn btn-light btn-lg">Registrasi</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Login</a>
    @endif
</div>

<div class="row g-4 text-center">
    <div class="col-md-4">
        <div class="card card-hover h-100 p-4">
            <div><span class="ikon-bulat mb-3"><i class="bi bi-journal-richtext"></i></span></div>
            <h5>Baca Artikel</h5>
            <p class="text-muted mb-0">Pelajari konsep kesetaraan gender melalui artikel yang mudah dipahami.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-hover h-100 p-4">
            <div><span class="ikon-bulat mb-3"><i class="bi bi-patch-question"></i></span></div>
            <h5>Uji Lewat Kuis</h5>
            <p class="text-muted mb-0">Kerjakan kuis pilihan ganda dan lihat pembahasan jawabannya.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-hover h-100 p-4">
            <div><span class="ikon-bulat mb-3"><i class="bi bi-chat-heart"></i></span></div>
            <h5>Beri Masukan</h5>
            <p class="text-muted mb-0">Sampaikan saran dan kritik supaya website ini makin baik.</p>
        </div>
    </div>
</div>
@endsection
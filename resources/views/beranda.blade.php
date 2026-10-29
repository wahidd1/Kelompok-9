@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center py-5">
        <h1 class="mb-3">Pahami apa itu Kesetaraan Gender</h1>
        <p class="lead">Temukan artikel edukatif, tingkatkan pemahaman, dan uji pengetahuan melalui kuis interaktif.</p>
        

        @if (session('login_role'))
            <a href="{{ route('artikel.index') }}" class="btn btn-primary">Baca Artikel</a>
            @if (session('login_role') === 'user')
                <a href="{{ route('kuis.index') }}" class="btn btn-outline-primary">Kerjakan Kuis</a>
            @endif
        @else
            <a href="{{ route('register') }}" class="btn btn-primary">Registrasi</a>
            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a> 
        @endif
    </div>
@endsection
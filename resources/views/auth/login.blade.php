@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm p-4">
            <h2 class="text-center mb-4">Login</h2>

            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="btn-group w-100 mb-4">
                <button type="button" id="tabUser" class="btn btn-primary" onclick="pilihRole('user')">User</button>
                <button type="button" id="tabAdmin" class="btn btn-outline-primary" onclick="pilihRole('admin')">Admin</button>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="hidden" name="role" id="inputRole" value="user">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
    </div>
</div>

<script>
function pilihRole(role) {
    document.getElementById('inputRole').value = role;

    document.getElementById('tabUser').classList.toggle('btn-primary', role === 'user');
    document.getElementById('tabUser').classList.toggle('btn-outline-primary', role !== 'user');

    document.getElementById('tabAdmin').classList.toggle('btn-primary', role === 'admin');
    document.getElementById('tabAdmin').classList.toggle('btn-outline-primary', role !== 'admin');
}
</script>
@endsection
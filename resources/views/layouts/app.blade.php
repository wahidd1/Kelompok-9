<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Edukasi Gender')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Header --}}
    @include ('partials.header')

    {{-- KONTEN --}}
    <main class="container mt-4 flex-grow-1">
        @if (session('error'))
            <div	class="alert	alert-danger">
                {{	session('error')	}}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    @include ('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
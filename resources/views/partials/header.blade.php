<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('beranda') }}">Edukasi Kesetaraan Gender</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="menuUtama">
            {{-- Menu kiri --}}
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('beranda') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('artikel.index') }}">Artikel</a></li>


                	@if	(session('login_role')	===	'user')
                        <li class="nav-item"><a classs="nav-link" href="{{ route('kuis.index') }}">Kuis</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('hasil.index') }}">Hasil Kuis</a></li>
                    @endif

                    @if (session('login_role')	===	'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.artikel.index') }}">Kelola Artikel</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.kuis.index') }}">Kelola Kuis</a></li>
                    @endif

                    {{-- Menu kanan: login / logout --}}
                    <ul class="navbar-nav align-items-lg-center">
                        @if (session('login_role'))
                           <li class="nav-item"><span class="navbar-text me-3">{{ session('login_name') }} ({{ session('login_role') }})</span></li>
                           <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                                </form>
                            </li> 
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrasi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li> 
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
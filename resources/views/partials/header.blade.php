<nav class="navbar navbar-expand-lg navbar-dark navbar-gender sticky-top">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="{{ route('beranda') }}">
            <i class="bi bi-gender-ambiguous me-1"></i> Edukasi Gender
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuUtama">
            {{-- Menu kiri --}}
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('artikel.*') ? 'active' : '' }}" href="{{ route('artikel.index') }}">Artikel</a>
                </li>
                @if (session('login_role') === 'user')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kuis.*') ? 'active' : '' }}" href="{{ route('kuis.index') }}">Kuis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('hasil.*') ? 'active' : '' }}" href="{{ route('hasil.index') }}">Hasil Kuis</a>
                    </li>
                @endif
                @if (session('login_role') === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}" href="{{ route('admin.artikel.index') }}">Kelola Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.kuis.*') ? 'active' : '' }}" href="{{ route('admin.kuis.index') }}">Kelola Kuis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}" href="{{ route('admin.feedback.index') }}">Kelola Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">Laporan</a>
                    </li>
                @endif
            </ul>
            {{-- Menu kanan: login / logout --}}
            <ul class="navbar-nav align-items-lg-center gap-lg-2">
                @if (session('login_role'))
                    <li class="nav-item">
                        <span class="navbar-text text-white">
                            <i class="bi bi-person-circle me-1"></i>{{ session('login_name') }}
                            <span class="badge bg-light text-dark ms-1">{{ session('login_role') }}</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrasi</a></li>
                    <li class="nav-item"><a class="btn btn-light btn-sm" href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
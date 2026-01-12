<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rekomendasi Makanan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">NutriMate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            {{-- NAVBAR UNTUK ADMIN --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" 
                                   href="{{ url('/admin/dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/manage-users') ? 'active' : '' }}" 
                                   href="{{ url('/admin/manage-users') }}">Kelola Pengguna</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/manage-menu') ? 'active' : '' }}" 
                                   href="{{ url('/admin/manage-menu') }}">Kelola Menu</a>
                            </li>
                        @else
                            {{-- NAVBAR UNTUK USER --}}
<li class="nav-item">
    <a class="nav-link {{ request()->is('/') || request()->is('home') ? 'active' : '' }}" 
       href="{{ url('/') }}">Home</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('form') ? 'active' : '' }}" 
       href="{{ auth()->check() ? url('/form') : url('/login') }}">
       Hitung Nutrisi
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('riwayat') ? 'active' : '' }}" 
       href="{{ route('riwayat') }}">
       Riwayat Menu
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" 
       href="{{ url('/tentang') }}">Tentang</a>
</li>

                        @endif
                    @else
                        {{-- NAVBAR UNTUK TAMU (BELUM LOGIN) --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') || request()->is('home') ? 'active' : '' }}" 
                               href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" 
                               href="{{ url('/tentang') }}">Tentang</a>
                        </li>
                    @endauth
                </ul>

                {{-- Bagian kanan navbar --}}
                @auth
                    <div class="d-flex align-items-center">
                        <span class="text-white me-3">Halo, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex">
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                        <a href="{{ url('/register') }}" class="btn btn-warning btn-sm">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-5 flex-fill">
        @yield('content')
    </div>

    <footer class="bg-success text-white text-center py-3 mt-auto shadow-sm">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} <strong>Rekomendasi Makanan</strong> — Semua Hak Dilindungi 🌿
            </p>
            <small>Dibuat dengan 💚 menggunakan Laravel & Bootstrap</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

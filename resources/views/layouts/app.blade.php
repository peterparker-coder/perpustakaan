<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Perpustakaan')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="app-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <h4>Perpustakaan</h4>
            <span>Sistem Pengelolaan</span>
        </div>

        <div class="menu-title">
            MENU UTAMA
        </div>

        <nav class="menu">

            <a href="#" class="menu-link">
                Dashboard
            </a>

            <a href="{{ route('categories.index') }}"
               class="menu-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                Kategori Buku
            </a>

            <a href="#" class="menu-link">
                Data Buku
            </a>

            <a href="#" class="menu-link">
                Data Anggota
            </a>

            <a href="#" class="menu-link">
                Peminjaman
            </a>

            <a href="#" class="menu-link">
                Pengembalian
            </a>

            <a href="#" class="menu-link">
                Riwayat
            </a>

        </nav>

        <div class="sidebar-footer">
            <small>Library Management System</small>
            <span>Laravel 10</span>
        </div>

    </aside>


    <!-- MAIN -->
    <main class="main-content">

        <header class="topbar">

            <div>
                <h5>@yield('title', 'Dashboard')</h5>
                <span>Sistem Perpustakaan</span>
            </div>

            <div class="admin-box">
                <strong>Administrator</strong>
                <small>Pengelola Perpustakaan</small>
            </div>

        </header>


        <section class="content-area">

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>
                </div>

            @endif

            @yield('content')

        </section>

    </main>

</div>

</body>
</html>
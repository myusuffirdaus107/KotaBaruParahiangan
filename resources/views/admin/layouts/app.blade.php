<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Properti Kotabaru')</title>
    <link rel="icon" href="{{ asset('images/logo_kbp.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css'])

    @yield('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon"><i class="fas fa-building"></i></div>
        <div class="sidebar-brand-text">
            <div class="title">Admin Panel</div>
            <div class="sub">Kotabaru Property</div>
        </div>
    </a>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-chart-line"></i></span> Dashboard
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.properties.index') }}" class="nav-link-item {{ Route::is('admin.properties.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-home"></i></span> Properties
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link-item {{ Route::is('admin.categories.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-tags"></i></span> Categories
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.sliders.index') }}" class="nav-link-item {{ Route::is('admin.sliders.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-images"></i></span> Sliders
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.launchings.index') }}" class="nav-link-item {{ Route::is('admin.launchings.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-rocket"></i></span> Launching
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.facilities.index') }}" class="nav-link-item {{ Route::is('admin.facilities.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-building"></i></span> Facilities
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.inquiries.index') }}" class="nav-link-item {{ Route::is('admin.inquiries.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-envelope"></i></span> Inquiries
            </a>
        </div>

        <div class="nav-divider"></div>
        <div class="nav-section-label">Pengaturan</div>
        <div class="nav-item">
            <a href="{{ route('admin.about.show') }}" class="nav-link-item {{ Route::is('admin.about.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-info-circle"></i></span> Tentang & Visi Misi
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link-item {{ Route::is('admin.users.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-users"></i></span> Admin Users
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.users.change-password') }}" class="nav-link-item {{ Route::is('admin.users.change-password') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-key"></i></span> Ganti Password
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('admin.logout') }}" method="post">
            @csrf
            <button type="submit" class="logout-btn">
                <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                Logout
            </button>
        </form>
    </div>
</aside>

{{-- TOPBAR --}}
<header class="topbar" id="topbar">
    <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="topbar-title">@yield('page-title', 'Admin Panel')</h1>
    </div>
    <div class="topbar-right">
        <a href="{{ route('home') }}" target="_blank" class="topbar-icon-btn" title="Lihat Website">
            <i class="fas fa-external-link-alt"></i>
        </a>
        <div class="user-chip">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <span class="user-name">{{ auth()->user()->name }}</span>
        </div>
    </div>
</header>

{{-- MAIN --}}
<div class="main-wrapper">
    <div class="page-content">

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Terjadi Kesalahan!</strong>
            @foreach($errors->all() as $error)<div class="mt-1">{{ $error }}</div>@endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@vite(['resources/js/admin.js'])
@yield('scripts')
</body>
</html>
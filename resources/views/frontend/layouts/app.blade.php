<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Properti Kotabaru - Rumah Impian Anda')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #3b82f6;
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --border-color: #e2e8f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #374151;
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-color);
        }
        
        /* Navigation Bar */
        nav {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 20px rgba(30, 58, 138, 0.15);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        nav .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        nav .navbar-brand i {
            font-size: 2rem;
        }
        
        nav .nav-link {
            color: rgba(255, 255, 255, 0.95) !important;
            margin: 0 25px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0 !important;
            position: relative;
        }
        
        nav .nav-link i {
            font-size: 1.3rem;
        }
        
        nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 0;
            height: 3px;
            background-color: var(--accent-color);
            transition: width 0.3s ease;
        }
        
        nav .nav-link:hover::after,
        nav .nav-link.active::after {
            width: 100%;
        }
        
        nav .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-2px);
        }
        
        nav .nav-link.active {
            color: var(--accent-color) !important;
        }
        
        /* Navbar Dropdown */
        nav .dropdown-menu {
            background-color: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            min-width: 200px;
        }
        
        nav .dropdown-item {
            color: var(--dark-color);
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 12px 20px;
        }
        
        nav .dropdown-item:hover {
            background-color: #f3f4f6;
            color: var(--accent-color);
            padding-left: 25px;
        }
        
        nav .dropdown-divider {
            border-color: #e5e7eb;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-color) 0%, #374151 100%);
            color: #ffffff;
            padding: 60px 0 30px;
            margin-top: 100px;
        }
        
        footer h5 {
            color: var(--accent-color);
            margin-bottom: 20px;
            font-size: 1.15rem;
            font-weight: 600;
        }
        
        footer p {
            color: #d1d5db;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        
        footer a {
            color: #f3f4f6;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        footer a:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }
        
        footer .social-links a {
            display: inline-flex;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        footer .social-links a:hover {
            background-color: var(--accent-color);
            transform: translateY(-3px);
            color: white;
        }
        
        footer .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 40px;
            padding-top: 30px;
            text-align: center;
            color: #9ca3af;
        }
        
        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid;
            animation: slideDown 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert-success {
            background-color: #d1fae5;
            border-left-color: #10b981;
            color: #065f46;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            border-left-color: #ef4444;
            color: #991b1b;
        }
        
        /* Property Cards */
        .property-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .property-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(30, 58, 138, 0.15);
        }
        
        .property-card .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: all 0.4s ease;
        }
        
        .property-card:hover .card-img-top {
            transform: scale(1.05);
        }
        
        .property-card .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        
        .property-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: white;
            padding: 8px 14px;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 10;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .property-price {
            color: var(--accent-color);
            font-weight: 700;
            font-size: 1.4rem;
            margin: 10px 0;
        }
        
        .property-location {
            color: #9ca3af;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }
        
        .btn-view {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: auto;
            text-decoration: none;
        }
        
        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(30, 58, 138, 0.3);
            color: white;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-building"></i> 
                <span>Properti Kotabaru</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('properties.hunian') ? 'active' : '' }}" href="{{ route('properties.hunian') }}">
                            <i class="fas fa-building"></i> Hunian
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('properties.business') ? 'active' : '' }}" href="{{ route('properties.business') }}">
                            <i class="fas fa-store"></i> Business
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-info-circle"></i> Tentang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                            <i class="fas fa-phone-alt"></i> Kontak
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @if ($errors->any())
            <div class="container-lg mt-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Terjadi Kesalahan!</h5>
                    @foreach ($errors->all() as $error)
                        <div class="mb-2">{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="container-lg mt-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        <div class="container-lg">
            <div class="row mb-5">
                <div class="col-md-4 col-lg-3 mb-4">
                    <h5>
                        <i class="fas fa-building"></i> Properti Kotabaru
                    </h5>
                    <p>Kami menyediakan solusi properti terbaik untuk kebutuhan hunian dan bisnis Anda di Kotabaru dengan harga kompetitif dan lokasi strategis.</p>
                </div>
                <div class="col-md-4 col-lg-3 mb-4">
                    <h5><i class="fas fa-link"></i> Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li class="mb-2"><a href="{{ route('properties.hunian') }}"><i class="fas fa-chevron-right"></i> Hunian</a></li>
                        <li class="mb-2"><a href="{{ route('properties.business') }}"><i class="fas fa-chevron-right"></i> Business</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-3 mb-4">
                    <h5><i class="fas fa-phone"></i> Contact Info</h5>
                    <p>
                        <i class="fas fa-phone-alt"></i> +62 812 3456 7890<br>
                        <i class="fas fa-envelope"></i> info@kotabaru.com<br>
                        <i class="fas fa-map-marker-alt"></i> Kotabaru, Indonesia
                    </p>
                </div>
                <div class="col-md-4 col-lg-3 mb-4">
                    <h5><i class="fas fa-share"></i> Follow Us</h5>
                    <div class="social-links">
                        <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 <strong>Properti Kotabaru</strong>. All rights reserved. Designed with <i class="fas fa-heart" style="color: #ff4757;"></i> by Development Team</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>

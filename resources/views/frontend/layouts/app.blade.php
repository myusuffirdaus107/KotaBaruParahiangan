<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Properti Kotabaru - Rumah Impian Anda')</title>
    <link rel="icon" href="{{ asset('images/logo_kbp.png') }}">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- CSS Global --}}
    @vite('resources/css/app.css')

    {{-- CSS per halaman --}}
    @stack('page-styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="main-nav" id="mainNav">
    <div class="container-lg px-3 px-lg-5">
        <a class="nav-brand" href="{{ route('home') }}">
            <img class="logo" src="{{ asset('images/logo_kotabaru.png') }}" alt="Kota Baru Parahyangan">
        </a>
        <button class="nav-toggler" id="navToggler" aria-label="Toggle navigation">
            <i class="fas fa-bars" id="togglerIcon"></i>
        </button>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}"               class="{{ Route::is('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="{{ route('properties.hunian') }}"  class="{{ Route::is('properties.hunian') ? 'active' : '' }}"><i class="fas fa-building"></i> Hunian</a></li>
            <li><a href="{{ route('properties.business') }}" class="{{ Route::is('properties.business') ? 'active' : '' }}"><i class="fas fa-store"></i> Business</a></li>
            <div class="nav-sep"></div>
            <li><a href="{{ route('about') }}"   class="{{ Route::is('about') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> Tentang</a></li>
            <li><a href="{{ route('kontak') }}"  class="{{ Route::is('kontak') ? 'active' : '' }}"><i class="fas fa-phone-alt"></i> Kontak</a></li>
        </ul>
    </div>
</nav>

{{-- CONTENT --}}
<main>
    @if($errors->any())
    <div class="container-lg mt-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Terjadi Kesalahan!</h5>
            @foreach($errors->all() as $error)<div class="mb-2">{{ $error }}</div>@endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="container-lg mt-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @yield('content')
</main>


{{-- FOOTER --}}
<footer class="site-footer">
    <div class="container-lg px-3 px-lg-5">
        <div class="sf-top">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="sf-brand">
                        <img src="{{ asset('images/logo_kotabaru.png') }}" alt="Kota Baru Parahyangan">
                        <p>Kawasan kota mandiri berwawasan pendidikan — menghadirkan hunian berkualitas dan lingkungan terpadu di Parahyangan.</p>
                    </div>
                    <div class="sf-socials">
                        <a href="https://facebook.com/kotabaruproperty"  target="_blank" class="sf-social"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com/kotabaruproperty" target="_blank" class="sf-social"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/082274226163"             target="_blank" class="sf-social"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.kotabaruproperty.com"       target="_blank" class="sf-social"><i class="fas fa-globe"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="sf-col-title">Navigasi</div>
                    <ul class="sf-links">
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                        <li><a href="{{ route('properties.hunian') }}"><i class="fas fa-chevron-right"></i> Hunian</a></li>
                        <li><a href="{{ route('properties.business') }}"><i class="fas fa-chevron-right"></i> Business</a></li>
                        <li><a href="{{ route('launching') }}"><i class="fas fa-chevron-right"></i> Launching</a></li>
                        <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> Tentang Kami</a></li>
                        <li><a href="{{ route('kawasan') }}"><i class="fas fa-chevron-right"></i> Kawasan</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="sf-col-title">Lainnya</div>
                    <ul class="sf-links">
                        <li><a href="{{ route('about') }}#fasilitas"><i class="fas fa-chevron-right"></i> Fasilitas</a></li>
                        <li><a href="{{ route('kontak') }}"><i class="fas fa-chevron-right"></i> Kontak</a></li>
                        <li><a href="{{ route('brochure') }}"><i class="fas fa-chevron-right"></i> E-Brochure</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sf-col-title">Hubungi Kami</div>
                    @foreach([
                        ['fas fa-phone-alt',     '<a href="tel:+6282274226163">+62 822 7422 6163</a>'],
                        ['fas fa-envelope',       '<a href="mailto:info@kotabaru.com">info@kotabaru.com</a>'],
                        ['fab fa-whatsapp',       '<a href="https://wa.me/082274226163" target="_blank">082274226163</a>'],
                        ['fas fa-map-marker-alt', 'Jl. Parahyangan No.1, Padalarang,<br>Kab. Bandung Barat, Jawa Barat'],
                    ] as [$ico, $val])
                    <div class="sf-contact-item">
                        <div class="ci-icon"><i class="{{ $ico }}"></i></div>
                        <div class="ci-text">{!! $val !!}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="sf-bottom">
            <div class="sf-copyright">&copy; {{ date('Y') }} <strong>Kota Baru Parahyangan</strong>. All rights reserved.</div>
            <div class="sf-legal">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

{{-- SCRIPTS --}}
{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- JS Global --}}
@vite('resources/js/app.js')

{{-- JS per halaman --}}
@stack('page-scripts')

</body>
</html>
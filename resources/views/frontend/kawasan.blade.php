@extends('frontend.layouts.app')
@section('title', 'Kawasan - Properti Kotabaru')

@push('page-styles')
    @vite(['resources/css/pages/kawasan.css'])
@endpush

@section('content')

{{--  HERO  --}}
<div class="kw-hero">
    <div class="kw-hero-bg">
        <img src="{{ asset('images/2.png') }}" alt="Kawasan Kotabaru">
    </div>
    <div class="kw-hero-body">
        <div>
            <div class="kw-hero-tag"><i class="fas fa-map-location-dot fa-xs"></i> Informasi Kawasan</div>
            <h1>Lokasi Strategis,<br><em>Nilai Tak Tertandingi</em></h1>
            <p class="kw-hero-desc">Kawasan Kotabaru Parahyangan hadir di titik terbaik — aksesibel, hijau, dan terus berkembang untuk generasi masa depan.</p>
        </div>
        <div class="kw-hero-stats">
            <div class="kw-stat"><div class="kw-stat-n">2.200<span style="font-size:1rem">Ha</span></div><div class="kw-stat-l">Luas Kawasan</div></div>
            <div class="kw-stat"><div class="kw-stat-n">15<span style="font-size:1rem">min</span></div><div class="kw-stat-l">Ke Tol Padalarang</div></div>
            <div class="kw-stat"><div class="kw-stat-n">30<span style="font-size:1rem">+</span></div><div class="kw-stat-l">Institusi Pendidikan</div></div>
            <div class="kw-stat"><div class="kw-stat-n">40<span style="font-size:1rem">%</span></div><div class="kw-stat-l">Area Terbuka Hijau</div></div>
        </div>
    </div>
</div>

{{--  LOKASI  --}}
<div class="kw-section">
    <div class="container-lg px-3 px-lg-5">
        <div class="kw-2col">
            <div>
                <x-frontend.section-header icon="fas fa-location-dot" label="Lokasi" title="Posisi Geografis<br><span>Yang Sempurna</span>" />
                <div class="mt-4">
                    <div class="kw-info-card">
                        <h3>Pusat Segala Kemudahan</h3>
                        <p>Terletak di Padalarang, Bandung Barat, kawasan ini menghubungkan ketenangan alam pegunungan Parahyangan dengan aksesibilitas kota besar.</p>
                    </div>
                    <div class="kw-info-card">
                        <h3>Aksesibilitas & Transportasi</h3>
                        <p>Terhubung langsung dengan Jalan Tol Padalarang–Cileunyi, jalur kereta Padalarang, dan rencana LRT Metropolita Bandung.</p>
                    </div>
                </div>
            </div>
            <div class="kw-img">
                <img src="{{ asset('images/IKEA_Store.jpg') }}" alt="Lokasi Kawasan">
            </div>
        </div>
    </div>
</div>

{{--  FASILITAS  --}}
<div class="kw-section alt">
    <div class="container-lg px-3 px-lg-5">
        <div class="text-center mb-5">
            <x-frontend.section-header icon="fas fa-building" label="Fasilitas" title="Semua Ada di <span>Satu Kawasan</span>" :center="true" />
        </div>
        <div class="kw-feat-grid">
            @foreach([
                ['fas fa-utensils', 'Pusat Perbelanjaan',  'Mall dan tenant brand ternama dalam kawasan'],
                ['fas fa-hospital', 'Fasilitas Kesehatan', 'RS modern dan klinik dengan pelayanan terpercaya'],
                ['fas fa-school',   'Pendidikan Lengkap',  'TK hingga universitas berstandar internasional'],
                ['fas fa-tree',     'Ruang Hijau',         'Taman dan jalur hijau seluas 40% dari total kawasan'],
                ['fas fa-dumbbell', 'Olahraga & Wellness', 'Sport club, kolam renang, jogging track'],
                ['fas fa-mug-hot',  'Restoran & Café',     'Beragam pilihan kuliner lokal dan internasional'],
            ] as [$ico, $ttl, $dsc])
            <a href="{{ route('about') }}#fasilitas" class="kw-feat text-decoration-none">
                <div class="kw-feat-ico"><i class="{{ $ico }}"></i></div>
                <h4>{{ $ttl }}</h4>
                <p>{{ $dsc }}</p>
            </a>
            @endforeach
        </div>
    </div>
</div>

{{--  KOMUNITAS  --}}
<div class="kw-section dark">
    <div class="container-lg px-3 px-lg-5">
        <div class="kw-2col">
            <div>
                <x-frontend.section-header
                    icon="fas fa-leaf"
                    label="Lingkungan & Komunitas"
                    title="Hidup Lebih Baik di<br><span style='color:var(--blue2)'>Lingkungan Terbaik</span>"
                    :dark="true"
                />
                <div class="mt-4">
                    <div class="kw-dark-card">
                        <div class="dc-ico"><i class="fas fa-users"></i></div>
                        <h3>Komunitas yang Solid</h3>
                        <p>Komunitas penghuni yang aktif dengan kegiatan sosial rutin — dari pasar pagi, festival budaya, hingga program olahraga bersama.</p>
                    </div>
                    <div class="kw-dark-card">
                        <div class="dc-ico"><i class="fas fa-seedling"></i></div>
                        <h3>Komitmen Keberlanjutan</h3>
                        <p>40% area terbuka hijau, sistem pengelolaan air terpadu, panel surya di fasilitas publik, dan program zero-waste.</p>
                    </div>
                </div>
            </div>
            <div class="kw-img">
                <img src="{{ asset('images/5.jpg') }}" alt="Komunitas" style="filter:brightness(.8) saturate(.85);">
            </div>
        </div>
    </div>
</div>

{{--  PERKEMBANGAN  --}}
<div class="kw-section">
    <div class="container-lg px-3 px-lg-5">
        <div class="kw-2col">
            <div class="kw-img">
                <img src="{{ asset('images/Mason_Pine_Hotel.jpg') }}" alt="Perkembangan">
            </div>
            <div>
                <x-frontend.section-header icon="fas fa-chart-line" label="Perkembangan" title="Investasi untuk<br><span>Masa Depan</span>" />
                <div class="kw-timeline mt-4">
                    @foreach([
                        ['2000 – 2005', 'Fondasi Kawasan',     'Pembangunan infrastruktur dasar, cluster pertama, dan fasilitas pendidikan awal.'],
                        ['2006 – 2018', 'Ekspansi & Pertumbuhan','Penambahan 15+ cluster hunian, sport club, dan pusat perbelanjaan dalam kawasan.'],
                        ['2019 – Sekarang','Era Smart Living',  'Integrasi teknologi smarthome, pengembangan MRT feeder, dan proyek mixed-use terbaru.'],
                        ['2025 – 2030', 'Rencana Masa Depan',  'Transit hub terpadu, business park internasional, dan pengembangan zona wellness eksklusif.'],
                    ] as [$yr, $ttl, $dsc])
                    <div class="kw-tl-item">
                        <div class="tl-year">{{ $yr }}</div>
                        <div class="tl-title">{{ $ttl }}</div>
                        <div class="tl-desc">{{ $dsc }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{--  CTA  --}}
<div class="kw-cta">
    <div class="container-lg px-3 px-lg-5">
        <h2>Tertarik Memiliki Properti<br><span>di Kawasan Kotabaru?</span></h2>
        <p>Konsultasikan kebutuhan properti Anda dengan tim profesional kami — gratis, tanpa komitmen.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('properties.hunian') }}" class="btn-prim"><i class="fas fa-search"></i> Cari Hunian</a>
            <a href="{{ route('about') }}#fasilitas"  class="btn-out"><i class="fas fa-arrow-left"></i> Kembali ke Tentang Kami</a>
        </div>
    </div>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
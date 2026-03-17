@extends('frontend.layouts.app')
@section('title', 'Tentang Kami - Properti Kotabaru')

@push('page-styles')
    @vite(['resources/css/pages/about.css'])
@endpush

@section('content')

{{-- HERO --}}
<div class="ab-hero">
    <div class="ab-hero-left">
        <div class="ab-tag"><i class="fas fa-city fa-xs"></i> Est. Since 2000</div>
        <h1>Kota Baru<br><em>Parahyangan</em></h1>
        <p>Kawasan kota mandiri berwawasan pendidikan — dirancang untuk kehidupan yang seimbang antara produktivitas, kenyamanan, dan alam.</p>
        <div class="ab-stats">
            <div>
                <div class="ab-stat-n">1500<sup style="font-size:1.2rem">+</sup></div>
                <div class="ab-stat-l">Unit Terjual</div>
            </div>
            <div>
                <div class="ab-stat-n">25<sup style="font-size:1.2rem">+</sup></div>
                <div class="ab-stat-l">Tahun Pengalaman</div>
            </div>
            <div>
                <div class="ab-stat-n">12</div>
                <div class="ab-stat-l">Fasilitas Publik</div>
            </div>
        </div>
    </div>
    <div class="ab-hero-right">
        <img src="{{ asset('images/kota_baru_town.png') }}"
             alt="Kota Baru Parahyangan">
        <div class="ab-float">
            <div class="fl">Rating Kepuasan</div>
            <div class="fv">4.9 <span style="color:var(--gold)">★</span></div>
            <div class="fs">dari 2.400+ penghuni</div>
        </div>
    </div>
</div>

{{-- ABOUT --}}
@if($about)
<div class="ab-about">
    <div class="container-lg px-3 px-lg-5">
        <div class="ab-grid">
            <div class="ab-img-wrap">
                <img src="{{ $about->image_path ? Storage::url($about->image_path) : 'https://images.unsplash.com/photo-1449844908441-8829872d2607?w=700&h=500&fit=crop' }}"
                     alt="{{ $about->section_title }}">
                <div class="ab-img-badge"><i class="fas fa-award"></i> Pengembang Terpercaya</div>
            </div>
            <div>
                <x-frontend.section-header
                    icon="fas fa-info-circle"
                    :label="$about->section_title"
                    title="Mengenal Lebih Dalam<br><span>Siapa Kami</span>"
                />
                <div class="ab-text mt-3"><p>{{ $about->description }}</p></div>
            </div>
        </div>
    </div>
</div>

{{-- VISION --}}
<div class="ab-vision">
    <div class="container-lg px-3 px-lg-5">
        <div class="ab-vis-grid">
            <div class="ab-vis-img">
                <img src="{{ $about->vision_mission_image ? Storage::url($about->vision_mission_image) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=700&h=500&fit=crop' }}"
                     alt="Visi Misi">
            </div>
            <div>
                <x-frontend.section-header
                    icon="fas fa-star"
                    :label="$about->vision_title"
                    title="Landasan <span style='color:var(--blue2)'>Kami Bergerak</span>"
                    :dark="true"
                />
                <div class="mt-3">
                    <div class="vl">Visi</div>
                    <div class="vh">{{ Str::limit($about->vision_content, 120) }}</div>
                    <div class="v-divider"></div>
                    <div class="vl">Misi</div>
                    <p class="vt">{{ $about->mission_content }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- KAWASAN BANNER --}}
<div class="container-lg px-3 px-lg-5">
    <div class="ab-kawasan-banner">
        <div>
            <div class="kb-badge"><i class="fas fa-map-location-dot fa-xs"></i> Jelajahi Kawasan</div>
            <h3>Kenali Lebih Dalam<br><span>Lokasi & Lingkungan</span> Kami</h3>
            <p>Temukan informasi lengkap tentang aksesibilitas, infrastruktur, lingkungan komunitas, dan potensi investasi kawasan Kotabaru Parahyangan.</p>
        </div>
        <a href="{{ route('kawasan') }}" class="btn-kawasan">
            <i class="fas fa-arrow-right"></i> Lihat Kawasan
        </a>
    </div>
</div>

{{-- FACILITIES --}}
<div class="ab-fac" id="fasilitas">
    <div class="container-lg px-3 px-lg-5">
        <div class="ab-fac-inner">
            <div class="text-center mb-5">
                <x-frontend.section-header
                    icon="fas fa-building"
                    label="Fasilitas Kami"
                    title="Fasilitas Publik <span>Tersedia</span>"
                    :center="true"
                />
            </div>
            <div class="fac-grid">
                @forelse($facilities as $facility)
                <a href="{{ route('facility.show', $facility->slug) }}" class="fac-item">
                    <div class="fac-ico"><i class="{{ $facility->icon }}"></i></div>
                    <span class="fac-name">{{ $facility->title }}</span>
                    <i class="fas fa-arrow-right fac-arrow"></i>
                </a>
                @empty
                <div style="grid-column:1/-1;text-align:center;padding:60px;color:#9ca3af;">
                    <i class="fas fa-info-circle me-2"></i> Fasilitas sedang diperbarui
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="ab-cta">
    <div class="container-lg px-3 px-lg-5">
        <h2>Siap Wujudkan<br><span>Hunian Impian Anda?</span></h2>
        <p>Konsultasikan kebutuhan properti Anda bersama tim ahli kami — gratis, tanpa komitmen.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('properties.hunian') }}" class="btn-primary-ab">
                <i class="fas fa-home"></i> Cari Properti
            </a>
            <a href="{{ route('kontak') }}" class="btn-outline-ab">
                <i class="fas fa-phone"></i> Hubungi Kami
            </a>
        </div>
    </div>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
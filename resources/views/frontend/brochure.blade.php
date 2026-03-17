@extends('frontend.layouts.app')
@section('title', 'E-Brochure - Properti Kotabaru')

@push('page-styles')
    @vite(['resources/css/pages/brochure.css'])
@endpush

@push('page-scripts')
    @vite(['resources/js/pages/brochure.js'])
@endpush

@section('content')

{{-- HERO --}}
<div class="br-hero">
    <div class="br-hero-bg">
        <img src="{{ asset('images/kota_baru_town.png') }}" alt="E-Brochure">
    </div>
    <div class="br-hero-body">
        <div>
            <div class="br-tag"><i class="fas fa-file-pdf fa-xs"></i> E-Brochure</div>
            <h1>Unduh <em>Brosur</em><br>Properti Kami</h1>
            <p class="br-hero-desc">Dapatkan informasi lengkap, spesifikasi, dan penawaran khusus setiap properti dalam format PDF siap cetak.</p>
        </div>
        <div class="br-count-badge">
            <div class="br-count-n">{{ $properties->count() }}</div>
            <div class="br-count-l">Brosur Tersedia</div>
        </div>
    </div>
</div>

{{-- FILTER --}}
<div class="br-filter">
    <span class="br-filter-label"><i class="fas fa-filter" style="font-size:.65rem;"></i> Filter:</span>
    <div class="br-filter-tabs">
        <button class="br-ftab active" data-cat="">Semua</button>
        @foreach($categories as $cat)
        <button class="br-ftab" data-cat="{{ $cat->id }}">{{ $cat->name }}</button>
        @endforeach
    </div>
</div>

{{-- GRID --}}
<div class="br-section">
    <div class="container-lg px-3 px-lg-5">
        <div class="br-grid" id="br-grid">
            @forelse($properties as $property)
            <div class="br-card" data-cat="{{ $property->category_id }}">
                <div class="br-card-img">
                    <img src="{{ $property->images->first() ? asset('storage/'.$property->images->first()->image_path) : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&h=400&fit=crop' }}"
                         alt="{{ $property->title }}" loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&h=400&fit=crop'">
                    <div class="br-cat-pill">{{ $property->category->name ?? 'Properti' }}</div>
                    <div class="br-pdf-badge"><i class="fas fa-file-pdf"></i></div>
                </div>
                <div class="br-card-body">
                    <h3>{{ $property->title }}</h3>
                    <p>{{ Str::limit($property->description, 90) }}</p>
                    <div class="br-card-meta">
                        <span><i class="fas fa-map-marker-alt"></i> {{ $property->location ?? 'Kotabaru' }}</span>
                        @if($property->bedrooms)
                        <span><i class="fas fa-bed"></i> {{ $property->bedrooms }} KT</span>
                        @endif
                    </div>
                    <div class="br-card-actions">
                        <a href="{{ $property->brochure ? route('brochure.download', $property->slug) : '#' }}" 
                        class="btn-dl {{ !$property->brochure ? 'disabled' : '' }}">
                            <i class="fas fa-cloud-download-alt"></i> Download</a>
                        <a href="{{ route('property.show', $property->slug) }}" class="btn-detail">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="br-empty">
                <i class="fas fa-inbox"></i>
                <p>Belum ada brosur tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="br-cta">
    <div class="container-lg px-3 px-lg-5">
        <h2>Butuh Informasi <span>Lebih Lanjut?</span></h2>
        <p>Tim kami siap membantu Anda memilih properti yang tepat.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="https://wa.me/082274226163?text={{ urlencode('Halo, saya ingin mengetahui lebih lanjut tentang properti Kotabaru Parahyangan') }}"
               target="_blank" class="btn-wa-br">
                <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
            </a>
            <a href="{{ route('kontak') }}" class="btn-nav"><i class="fas fa-envelope"></i> Form Kontak</a>
        </div>
        <div class="mt-4 d-flex gap-4 justify-content-center flex-wrap">
            <a href="{{ route('home') }}" class="btn-nav"><i class="fas fa-home"></i> Beranda</a>
            <a href="{{ route('properties.hunian') }}" class="btn-nav"><i class="fas fa-building"></i> Hunian</a>
            <a href="{{ route('properties.business') }}" class="btn-nav"><i class="fas fa-briefcase"></i> Business</a>
        </div>
    </div>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
@extends('frontend.layouts.app')
@section('title', 'Launching Terbaru - Properti Kotabaru')

@push('page-styles')
    @vite(['resources/css/pages/launching.css'])
@endpush

@push('page-scripts')
    @vite(['resources/js/pages/launching.js'])
@endpush

@section('content')

{{--  HERO  --}}
<div class="lc-hero">
    <div class="lc-hero-bg">
        <img src="{{ asset('images/2.png') }}" alt="Launching Terbaru">
    </div>
    <div class="lc-hero-body">
        <div class="lc-tag"><i class="fas fa-rocket fa-xs"></i> New Launching</div>
        <h1>Proyek <em>Terbaru</em><br>dari Kami</h1>
        <p class="lc-hero-desc">Temukan hunian dan properti terbaru dari pengembang terpercaya di kawasan Kotabaru Parahyangan.</p>
    </div>
</div>

{{--  FILTER  --}}
<div class="lc-filter">
    <button class="lc-filter-btn active" data-filter="all"><span class="dot"></span> Semua</button>
    <button class="lc-filter-btn" data-filter="active"><span class="dot"></span> Tersedia</button>
    <button class="lc-filter-btn" data-filter="coming_soon"><span class="dot"></span> Coming Soon</button>
</div>

{{--  GRID  --}}
<div class="lc-section">
    <div class="container-lg px-3 px-lg-5">
        <div class="lc-grid">
            @forelse($launchings as $l)
            <div class="lc-card"
                 data-status="{{ $l->status }}"
                 data-title="{{ $l->title }}"
                 data-desc="{{ $l->description }}"
                 data-image="{{ $l->image ? asset('storage/'.$l->image) : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=600&fit=crop' }}"
                 data-location="{{ $l->location }}"
                 data-developer="{{ $l->developer }}"
                 data-date="{{ $l->launch_date ? \Carbon\Carbon::parse($l->launch_date)->format('d M Y') : '-' }}"
                 data-status-label="{{ $l->status === 'active' ? 'Tersedia' : 'Coming Soon' }}"
                 onclick="openModal(this)">
                <div class="lc-card-img">
                    <img src="{{ $l->image ? asset('storage/'.$l->image) : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600&h=400&fit=crop' }}"
                         alt="{{ $l->title }}" loading="lazy">
                    <div class="lc-pill {{ $l->status === 'active' ? 'active' : 'coming' }}">
                        <i class="fas {{ $l->status === 'active' ? 'fa-check-circle' : 'fa-hourglass-half' }}"></i>
                        {{ $l->status === 'active' ? 'Tersedia' : 'Coming Soon' }}
                    </div>
                    @if($l->launch_date)
                    <div class="lc-date-chip">
                        <i class="fas fa-calendar-alt" style="font-size:.55rem;"></i>
                        {{ \Carbon\Carbon::parse($l->launch_date)->format('d M Y') }}
                    </div>
                    @endif
                </div>
                <div class="lc-card-body">
                    <h3>{{ $l->title }}</h3>
                    <div class="lc-card-meta">
                        @if($l->location)<span><i class="fas fa-map-marker-alt"></i> {{ $l->location }}</span>@endif
                        @if($l->developer)<span><i class="fas fa-building"></i> {{ $l->developer }}</span>@endif
                    </div>
                </div>
                <div class="lc-card-footer">
                    <span class="see-more">Lihat Detail <i class="fas fa-arrow-right" style="font-size:.6rem;"></i></span>
                    @if($l->launch_date)
                    <span class="dev"><i class="fas fa-calendar" style="font-size:.6rem;color:var(--blue);"></i> {{ \Carbon\Carbon::parse($l->launch_date)->format('M Y') }}</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="lc-empty">
                <i class="fas fa-inbox"></i>
                <p>Belum ada proyek launching yang tersedia.</p>
            </div>
            @endforelse
        </div>
        @if($launchings->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $launchings->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

{{--  MODAL  --}}
<div class="lc-modal-backdrop" id="lcModal" onclick="closeModalOutside(event)">
    <div class="lc-modal" role="dialog" aria-modal="true">
        <div class="lc-modal-img" id="modalImg">
            <img src="" alt="" id="modalImage">
            <button class="lc-modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            <div class="lc-modal-img-info">
                <div class="mi-pill active" id="modalPill"></div>
                <h2 id="modalImgTitle"></h2>
            </div>
        </div>
        <div class="lc-modal-body">
            <div>
                <div class="lc-modal-section-label">Deskripsi</div>
                <p class="lc-modal-desc" id="modalDesc"></p>
            </div>
            <div class="lc-modal-divider"></div>
            <div class="lc-modal-info-grid">
                <div><div class="lc-modal-section-label">Lokasi</div><div class="lc-modal-section-val" id="modalLocation"></div></div>
                <div><div class="lc-modal-section-label">Developer</div><div class="lc-modal-section-val" id="modalDeveloper"></div></div>
                <div><div class="lc-modal-section-label">Tanggal Launching</div><div class="lc-modal-section-val" id="modalDate"></div></div>
                <div><div class="lc-modal-section-label">Status</div><div class="lc-modal-section-val" id="modalStatus"></div></div>
            </div>
            <div class="lc-modal-divider"></div>
            <a href="https://wa.me/082274226163" target="_blank" class="lc-modal-wa" id="modalWa">
                <i class="fab fa-whatsapp" style="font-size:1.1rem;"></i> Tanyakan via WhatsApp
            </a>
        </div>
    </div>
</div>

{{--  CTA  --}}
<div class="lc-cta">
    <div class="container-lg px-3 px-lg-5">
        <h2>Ingin Info <span>Launching Terbaru?</span></h2>
        <p>Hubungi tim kami langsung atau jelajahi properti yang tersedia sekarang.</p>
        <div class="justify-content-center mb-3">
            <a href="https://wa.me/082274226163?text={{ urlencode('Halo, saya ingin mendapatkan informasi launching terbaru Kotabaru Parahyangan') }}"
               target="_blank" class="btn-wa-cta">
                <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
            </a>
        </div>
        <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
            <a href="{{ route('home') }}"                class="btn-nav"><i class="fas fa-home"></i> Beranda</a>
            <a href="{{ route('properties.hunian') }}"   class="btn-nav"><i class="fas fa-building"></i> Lihat Hunian</a>
            <a href="{{ route('properties.business') }}" class="btn-nav"><i class="fas fa-briefcase"></i> Business</a>
        </div>
    </div>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
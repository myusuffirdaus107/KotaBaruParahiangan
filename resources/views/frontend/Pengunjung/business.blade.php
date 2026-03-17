@extends('frontend.layouts.app')
@section('title', 'Business Properties — Properti Kotabaru')

@push('page-styles')
    @vite(['resources/css/pages/business.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@push('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @php
        $bpData = $properties->map(fn($p) => [
            'id'          => $p->id,
            'title'       => $p->title,
            'location'    => $p->location,
            'description' => $p->description,
            'status'      => $p->status,
            'category'    => $p->category->name ?? 'Business',
            'brochure'    => $p->brochure ? asset('storage/'.$p->brochure) : null,
            'images'      => $p->images->pluck('image_path')->values()->all(),
        ])->values();
    @endphp
    <script>window.bpProps = {!! json_encode($bpData) !!};</script>
    @vite(['resources/js/pages/business.js'])
@endpush

@section('content')

{{-- ═══ HERO ═══ --}}
<div class="bp-hero">
    <div class="bp-hero-left">
        <h1>Business<br><span>Properties</span></h1>
        <p class="bp-hero-desc">Temukan ruang usaha prestisius di lokasi strategis — dirancang untuk bisnis yang mengutamakan citra dan nilai investasi jangka panjang.</p>
        <div class="bp-hero-stats">
            <div>
                <div class="bp-stat-num">{{ $properties->count() }}<span>+</span></div>
                <div class="bp-stat-label">Unit Tersedia</div>
            </div>
            <div class="bp-stat-div"></div>
            <div>
                <div class="bp-stat-num">3</div>
                <div class="bp-stat-label">Zona Komersial</div>
            </div>
            <div class="bp-stat-div"></div>
            <div>
                <div class="bp-stat-num">1</div>
                <div class="bp-stat-label">Kawasan Elite</div>
            </div>
        </div>
    </div>
    <div class="bp-hero-right">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=900&h=340&fit=crop"
             alt="Business Properties Kotabaru">
    </div>
</div>

{{-- ═══ ZONA MAP ═══ --}}
<div class="zs-section">
    <div class="zs-head">
        <div class="zs-head-tag"><i class="fas fa-map-marked-alt"></i> Kawasan Komersial</div>
        <h2>Tiga Zona <span>Strategis</span></h2>
        <p>
            Kota Baru Parahyangan mengembangkan kawasan sentra ekonomi yang secara strategis dibagi atas zona;<br>
            <strong>Regional Komersial, Town Center, dan Resort Komersial.</strong><br>
            Area komersial ini akan menjadi pusat perekonomian baru yang memajukan kota mandiri dan sekitarnya.
        </p>
    </div>
    <div class="zs-body">
        <div class="zs-map-wrap">
            <img src="{{ asset('images/Zona.png') }}" alt="Peta Zona Komersial">
            <div class="zs-zone resort"   style="left:28%;top:52%;"><div class="zs-zone-dot"></div><div class="zs-zone-label">Resort</div></div>
            <div class="zs-zone town"     style="left:51%;top:44%;"><div class="zs-zone-dot"></div><div class="zs-zone-label">Town Center</div></div>
            <div class="zs-zone regional" style="left:72%;top:22%;"><div class="zs-zone-dot"></div><div class="zs-zone-label">Regional</div></div>
        </div>
        <div class="zs-legend">
            <div class="zs-legend-card resort">
                <div class="zs-legend-icon">🏖</div>
                <div class="zs-legend-info"><h4>Resort Komersial</h4><p>Kawasan bisnis bernuansa resort dengan konsep leisure & hospitality.</p></div>
            </div>
            <div class="zs-legend-card town">
                <div class="zs-legend-icon">🏙</div>
                <div class="zs-legend-info"><h4>Town Center</h4><p>Pusat kota modern sebagai hub aktivitas bisnis, retail, dan perkantoran utama.</p></div>
            </div>
            <div class="zs-legend-card regional">
                <div class="zs-legend-icon">🌐</div>
                <div class="zs-legend-info"><h4>Regional Komersial</h4><p>Kawasan komersial skala regional yang menghubungkan Kota Baru Parahyangan dengan pusat ekonomi Bandung.</p></div>
            </div>
        </div>
    </div>
    <div class="zs-divider">
        <div class="zs-divider-line"></div>
        <div class="zs-divider-text">Pilihan Properti Tersedia</div>
        <div class="zs-divider-line"></div>
    </div>
</div>

{{-- ═══ SEARCH & FILTER ═══ --}}
<div class="bp-filter-section">
    <div class="container-lg px-3 px-lg-5">
        <div class="bp-filter-heading">
            <h2>Temukan Properti <em>Bisnis</em> Anda</h2>
            <p>Cari berdasarkan nama, lokasi, atau pilih kategori yang sesuai</p>
        </div>
        <div class="bp-filter-card">
            <div class="bp-search-field">
                <i class="fas fa-search sf-icon"></i>
                <input type="text" class="bp-search-input" id="bpSearch"
                       placeholder="Cari nama properti atau lokasi...">
                <button class="bp-search-clear" id="bpSearchClear" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="bp-cat-dropdown" id="bpCatDropdown">
                <button class="bp-cat-btn" id="bpCatBtn" onclick="toggleCatDropdown()">
                    <i class="fas fa-layer-group" style="font-size:.8rem;opacity:.7;"></i>
                    <span class="cb-label" id="bpCatLabel">Semua Kategori</span>
                    <span class="cb-count" id="bpCatCount">{{ $properties->count() }}</span>
                    <i class="fas fa-chevron-down cb-chevron"></i>
                </button>
                <div class="bp-cat-panel" id="bpCatPanel">
                    <div class="bp-cat-panel-head">Pilih Kategori</div>
                    <button class="bp-cat-option active"
                            data-cat="" data-label="Semua Kategori"
                            data-count="{{ $properties->count() }}"
                            onclick="selectCat(this)">
                        Semua Kategori
                        <span style="display:flex;align-items:center;gap:8px;">
                            <span class="co-count">{{ $properties->count() }}</span>
                            <i class="fas fa-check co-check"></i>
                        </span>
                    </button>
                    @foreach($properties->pluck('category')->filter()->unique('id') as $cat)
                    <button class="bp-cat-option"
                            data-cat="{{ $cat->id }}"
                            data-label="{{ $cat->name }}"
                            data-count="{{ $properties->where('category_id', $cat->id)->count() }}"
                            onclick="selectCat(this)">
                        {{ $cat->name }}
                        <span style="display:flex;align-items:center;gap:8px;">
                            <span class="co-count">{{ $properties->where('category_id', $cat->id)->count() }}</span>
                            <i class="fas fa-check co-check"></i>
                        </span>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bp-result-bar">
            <span>Menampilkan <strong id="bpResultCount">{{ $properties->count() }}</strong> properti bisnis</span>
            <button class="reset-all" id="bpResetAll" onclick="resetAll()">
                <i class="fas fa-rotate-left"></i> Reset
            </button>
        </div>
    </div>
</div>

{{-- ═══ ZIG-ZAG LIST ═══ --}}
<div class="bp-list" id="bpList">
    @forelse($properties as $property)
    <div class="bp-item"
         data-cat="{{ $property->category_id }}"
         data-status="{{ $property->status }}"
         data-title="{{ strtolower($property->title) }}"
         data-location="{{ strtolower($property->location) }}">
        <div class="bp-item-visual">
            <img src="{{ $property->images->count() ? asset('storage/'.$property->images->first()->image_path) : 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=800&h=560&fit=crop' }}"
                 alt="{{ $property->title }}" loading="lazy">
            <div class="vi-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
            <div class="vi-status {{ $property->status === 'available' ? 'avail' : 'sold' }}">
                {{ $property->status === 'available' ? 'Tersedia' : 'Sold Out' }}
            </div>
        </div>
        <div class="bp-item-body">
            <div class="bp-item-cat">{{ $property->category->name ?? 'Business' }}</div>
            <h2 class="bp-item-title" data-raw="{{ $property->title }}">{{ $property->title }}</h2>
            <div class="bp-item-loc"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</div>
            <div class="bp-item-divider"></div>
            <p class="bp-item-desc">{{ Str::limit($property->description, 240) }}</p>
            <div class="bp-item-actions">
                <button class="btn-bp-primary" onclick="openBpModal({{ $property->id }})">
                    <i class="fas fa-eye"></i> Lihat Detail
                </button>
                @if($property->brochure)
                <a href="{{ asset('storage/'.$property->brochure) }}" class="btn-bp-ghost" download>
                    <i class="fas fa-file-pdf"></i> E-Brochure
                </a>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="bp-empty-state show">
        <div class="bp-es-icon"><i class="fas fa-building"></i></div>
        <div class="bp-es-title">Belum Ada Properti Bisnis</div>
        <div class="bp-es-sub">Data properti bisnis belum tersedia saat ini.</div>
    </div>
    @endforelse
</div>

{{-- Empty state filter --}}
<div class="bp-empty-state" id="bpEmptyState">
    <div class="bp-es-icon"><i class="fas fa-search"></i></div>
    <div class="bp-es-title">Properti Tidak Ditemukan</div>
    <div class="bp-es-sub">Tidak ada properti yang cocok dengan filter Anda.</div>
    <button class="bp-es-reset" onclick="resetAll()"><i class="fas fa-rotate-left"></i> Reset Filter</button>
</div>

{{-- ═══ MODAL ═══ --}}
<div class="bp-modal" id="bpModal" onclick="if(event.target===this)closeBpModal()">
    <div class="bp-modal-box">
        <div class="bp-modal-gallery">
            <button class="bp-modal-close" onclick="closeBpModal()"><i class="fas fa-times"></i></button>
            <div class="swiper bpSwiper">
                <div class="swiper-wrapper" id="bpSwiperWrapper"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="bp-modal-counter" id="bpCounter"></div>
        </div>
        <div class="bp-modal-body" id="bpModalBody"></div>
    </div>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
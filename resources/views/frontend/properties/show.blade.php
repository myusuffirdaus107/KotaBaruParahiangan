@extends('frontend.layouts.app')
@section('title', $property->title . ' - ' . $property->category->name)

@push('page-styles')
    @vite(['resources/css/pages/show.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@push('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>window.propImages = @json($property->images->pluck('image_path'));</script>
    @vite(['resources/js/pages/show.js'])
@endpush

@php
function formatDescription(string $text): string {
    $lines = explode("\n", $text);
    $html = ''; $bulletBuf = [];
    $flushBullets = function () use (&$bulletBuf, &$html) {
        if (!empty($bulletBuf)) {
            $html .= '<ul>';
            foreach ($bulletBuf as $b) $html .= '<li>' . e($b) . '</li>';
            $html .= '</ul>';
            $bulletBuf = [];
        }
    };
    foreach ($lines as $line) {
        $trimmed = trim($line);
        if ($trimmed === '') { $flushBullets(); continue; }
        if (preg_match('/^[-•]\s+(.+)/', $trimmed, $m)) {
            $bulletBuf[] = $m[1];
        } else {
            $flushBullets();
            $html .= '<p>' . e($trimmed) . '</p>';
        }
    }
    $flushBullets();
    return $html;
}
@endphp

@section('content')

 {{--  HERO  --}}
<section class="prop-hero">
    <div class="swiper propHeroSwiper">
        <div class="swiper-wrapper">
            @forelse($property->images as $img)
            <div class="swiper-slide">
                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $property->title }}">
            </div>
            @empty
            <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&h=900&fit=crop"
                     alt="{{ $property->title }}">
            </div>
            @endforelse
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-caption">
        <div>
            <span class="cat-badge">{{ $property->category->name }}</span>
            <h1>Tatar {{ $property->title }}</h1>
            <div class="loc"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</div>
        </div>
    </div>
</section>

{{--  MAIN  --}}
<div class="prop-main">
    <div>
        {{-- Deskripsi --}}
        <div class="sec">
            <div class="sec-label">Tentang Properti</div>
            <h2>Tatar {{ $property->title }}</h2>
            <div class="prop-description">{!! formatDescription($property->description ?? '') !!}</div>
        </div>

        {{-- Spesifikasi --}}
        <div class="sec">
            <div class="sec-label">Spesifikasi</div>
            <div class="specs-grid">
                <div class="spec-item">
                    <div class="lbl">Kategori</div>
                    <div class="val">{{ $property->category->name }}</div>
                </div>
                <div class="spec-item">
                    <div class="lbl">Lokasi</div>
                    <div class="val" style="font-size:.95rem;">{{ $property->location }}</div>
                </div>
                <div class="spec-item">
                    <div class="lbl">Status</div>
                    <div class="val">
                        @if($property->status === 'available')
                            <span class="badge-avail">
                                <span style="width:6px;height:6px;background:#22c55e;border-radius:50%;display:inline-block;"></span> Tersedia
                            </span>
                        @else
                            <span class="badge-sold">
                                <span style="width:6px;height:6px;background:#ef4444;border-radius:50%;display:inline-block;"></span> Sold Out
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Galeri --}}
        @if($property->images->count() > 0)
        <div class="sec">
            <div class="sec-label">Galeri Foto</div>
            <div class="gal-grid" id="galGrid">
                @foreach($property->images->take(5) as $img)
                <div class="g-item" onclick="openModal({{ $loop->index }})">
                    <img src="{{ asset('storage/'.$img->image_path) }}" alt="Foto {{ $loop->iteration }}" loading="lazy">
                    <div class="g-ov"><i class="fas fa-expand"></i></div>
                </div>
                @endforeach
            </div>
            @if($property->images->count() > 5)
            <button class="btn-more-gal" onclick="showAll()">
                <i class="fas fa-images"></i> Lihat semua {{ $property->images->count() }} foto
            </button>
            @endif
        </div>
        @endif

        {{-- Brosur --}}
        @if($property->brochure)
        <div class="sec">
            <div class="sec-label">E-Brochure</div>
            <p style="margin-bottom:18px;">Unduh brosur lengkap untuk informasi detail properti ini.</p>
            <a href="{{ $property->brochure ? route('brochure.download', $property->slug) : '#' }}" 
                class="btn-brochure {{ !$property->brochure ? 'disabled' : '' }}"> 
                <i class="fas fa-file-pdf"></i> Download E-Brochure
            </a>
        </div>
        @endif
    </div>

    {{-- Sidebar --}}
    <div class="prop-sidebar">
        @if($property->status === 'available')
        <div class="contact-card">
            <div class="contact-card-head">
                <h3>Hubungi Kami</h3>
                <p>Tim kami siap membantu Anda</p>
            </div>
            <div class="contact-card-body">
                <form action="{{ route('inquiry.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <div class="cform-group">
                        <label>Nama</label>
                        <input type="text" name="name" placeholder="Nama lengkap" value="{{ old('name') }}" required>
                        @error('name')<span style="color:#ef4444;font-size:.72rem;">{{ $message }}</span>@enderror
                    </div>
                    <div class="cform-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email@anda.com" value="{{ old('email') }}" required>
                        @error('email')<span style="color:#ef4444;font-size:.72rem;">{{ $message }}</span>@enderror
                    </div>
                    <div class="cform-group">
                        <label>Telepon</label>
                        <input type="tel" name="phone" placeholder="+62 xxx" value="{{ old('phone') }}" required>
                        @error('phone')<span style="color:#ef4444;font-size:.72rem;">{{ $message }}</span>@enderror
                    </div>
                    <div class="cform-group">
                        <label>Pesan</label>
                        <textarea name="message" placeholder="Tuliskan pertanyaan Anda...">{{ old('message') }}</textarea>
                        @error('message')<span style="color:#ef4444;font-size:.72rem;">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn-send"><i class="fas fa-paper-plane"></i> Kirim Pesan</button>
                </form>
            </div>
        </div>
        @endif

        @if($relatedProperties->count() > 0)
        <div class="related-box">
            <h4>Properti Terkait</h4>
            @foreach($relatedProperties as $rel)
            <a href="{{ route('property.show', $rel->slug) }}" class="rel-item">
                @if($rel->images->count() > 0)
                    <img src="{{ asset('storage/'.$rel->images->first()->image_path) }}" alt="{{ $rel->title }}">
                @else
                    <div style="width:56px;height:56px;border-radius:7px;background:#f3f4f6;display:grid;place-items:center;flex-shrink:0;">
                        <i class="fas fa-home" style="color:#d1d5db;"></i>
                    </div>
                @endif
                <div>
                    <p class="rel-name">Tatar {{ $rel->title }}</p>
                    <div class="rel-loc"><i class="fas fa-map-marker-alt"></i> {{ $rel->location }}</div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Modal --}}
<div class="img-modal" id="imgModal" onclick="if(event.target===this)closeModal()">
    <button class="img-modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
    <div class="modal-counter" id="modalCounter"></div>
    <div class="modal-swiper-wrap">
        <div class="swiper modalSwiper">
            <div class="swiper-wrapper" id="modalSwiperWrapper"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
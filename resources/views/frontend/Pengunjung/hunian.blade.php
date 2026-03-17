@extends('frontend.layouts.app')
@section('title', 'Hunian - Properti Kotabaru')

@push('page-styles')
    @vite(['resources/css/pages/hunian.css'])
@endpush

@section('content')

{{--  HERO  --}}
<div class="hn-hero">
    <div class="hn-hero-img">
        @php $heroImg = $properties->first()?->images->first(); @endphp
        <img src="{{ $heroImg ? asset('storage/'.$heroImg->image_path) : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=1400&h=700&fit=crop' }}"
             alt="Hunian Kotabaru">
    </div>
    <div class="hn-hero-arc"></div>
    <div class="hn-hero-body">
        <div class="hn-hero-left">
            <h1>Your Gateway to<br>a <span>Better Life</span></h1>
            <p>Temukan hunian impian yang lebih dari sekadar tempat tinggal — dirancang untuk kehidupan modern yang nyaman dan harmonis bersama keluarga.</p>
            <a href="#hn-list" class="btn-hn">
                <i class="fas fa-search"></i> Lihat Hunian
            </a>
        </div>
    </div>
</div>

{{--  LIST  --}}
<div class="hn-section" id="hn-list">
    <div class="hn-sec-head">
        <div>
            <h2>Pilihan <span>Hunian</span> Kami</h2>
            <p>Temukan tipe hunian yang paling sesuai dengan kebutuhan Anda</p>
            <div class="hn-sec-line"></div>
        </div>
    </div>

    @if($properties->isEmpty())
        <div class="hn-empty">
            <i class="fas fa-home"></i>
            <h3>Hunian Tidak Ditemukan</h3>
            <p>Tidak ada data hunian yang tersedia saat ini.</p>
        </div>
    @else
        <div class="hn-masonry">
            @foreach($properties as $i => $property)
            <a href="{{ route('property.show', $property->slug) }}" class="text-decoration-none">
                <div class="hn-tile {{ $i === 0 ? 'feat' : '' }}">
                    <div class="ti">
                        <img src="{{ $property->images->count() ? asset('storage/'.$property->images->first()->image_path) : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=700&h=500&fit=crop' }}"
                             alt="{{ $property->title }}" loading="lazy">
                    </div>
                    <div class="tc">
                        <div class="tc-top">
                            <span class="tc-cat">{{ $property->category->name ?? 'Hunian' }}</span>
                            <span class="tc-badge {{ $property->status === 'available' ? 'avail' : 'sold' }}">
                                {{ $property->status === 'available' ? 'Tersedia' : 'Sold Out' }}
                            </span>
                        </div>
                        <h3>TATAR {{ strtoupper($property->title) }}</h3>
                        <div class="tc-loc"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</div>
                        <hr class="tc-divider">
                        <div class="tc-acts">
                            <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20{{ urlencode($property->title) }}"
                               target="_blank" class="btn-wa">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="{{ route('property.show', $property->slug) }}" class="btn-dt">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
@extends('frontend.layouts.app')
@section('title', $pageTitle)

@push('page-styles')
    @vite(['resources/css/pages/facility.css'])
@endpush

@section('content')

<div class="fh-hero-wrap">
    <div class="fh-hero">
        <div class="fh-bg">
            <img src="{{ $facility->banner ? asset('storage/'.$facility->banner) : asset('images/12.jpg') }}"
                 alt="{{ $facility->title }}">
        </div>
        <div class="fh-body">
            <div>
                <div class="fh-bc">
                    <a href="{{ route('about') }}">Tentang Kami</a>
                    <i class="fas fa-chevron-right" style="font-size:.5rem;"></i>
                    <a href="{{ route('about') }}#fasilitas">Fasilitas</a>
                    <i class="fas fa-chevron-right" style="font-size:.5rem;"></i>
                    <span>{{ $facility->title }}</span>
                </div>
                <div class="fh-tag"><i class="{{ $facility->icon }} fa-xs"></i> Fasilitas Publik</div>
                <h1>{{ $facility->title }}</h1>
                <p class="fh-desc">{{ $facility->description }}</p>
            </div>
            <div class="fh-icon-block"><i class="{{ $facility->icon }}"></i></div>
        </div>
    </div>
</div>

{{--  ITEMS  --}}
<div class="fh-items">
    <div class="container-lg px-3 px-lg-5">
        <div class="fh-items-head">
            <div>
                <x-frontend.section-header
                    icon="fas fa-list-ul"
                    label="Daftar Fasilitas"
                    title="Kenali <span>{{ $facility->title }}</span>"
                />
            </div>
            @if($facility->facilityItems->count() > 0)
                <div class="item-count">{{ str_pad($facility->facilityItems->count(), 2, '0', STR_PAD_LEFT) }}</div>
            @endif
        </div>
        @php
            $items     = $facility->facilityItems;
            $total     = $items->count();
            $remainder = $total % 3;
        @endphp
        <div class="fh-grid">
            @forelse($items as $i => $item)
            @php
                $isLast    = ($i === $total - 1);
                $spanClass = '';
                if ($isLast && $remainder === 1) $spanClass = 'span-3';
                elseif ($isLast && $remainder === 2) $spanClass = 'span-2';
            @endphp
            <div class="fh-card {{ $spanClass }}">
                <div class="fh-card-img">
                    <img src="{{ $item->image ? Storage::url($item->image) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&h=400&fit=crop' }}"
                         alt="{{ $item->name }}" loading="lazy">
                    <div class="fh-card-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div class="fh-card-body">
                    <h3>{{ $item->name }}</h3>
                    <p>{{ $item->description }}</p>
                    <div class="fh-card-line"></div>
                </div>
            </div>
            @empty
            <div class="fh-empty">
                <i class="fas fa-inbox"></i>
                <p>Belum ada item yang tersedia untuk fasilitas ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{--  CTA  --}}
<div class="fh-cta">
    <div class="container-lg px-3 px-lg-5">
        <h2>Tertarik dengan<br><span>{{ $facility->title }}?</span></h2>
        <p>Hubungi tim kami untuk informasi lebih lanjut dan jadwalkan kunjungan Anda.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('properties.hunian') }}" class="btn-prim"><i class="fas fa-home"></i> Lihat Properti</a>
            <a href="{{ route('about') }}#fasilitas"  class="btn-out"><i class="fas fa-arrow-left"></i> Kembali ke Fasilitas</a>
        </div>
    </div>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
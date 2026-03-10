@extends('frontend.layouts.app')

@section('title', $pageTitle)

@section('styles')
<style>
    .facility-hero-banner {
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        width: 100vw;
        height: 550px;
        margin-left: calc(-50vw + 50%);
        margin-bottom: 60px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        overflow: hidden;
        border-radius: 0;
    }

    .facility-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%);
        z-index: 1;
    }

    .facility-hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        padding: 40px;
    }

    .facility-hero-content h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        font-weight: 700;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 25px;
    }

    .facility-hero-content h1 i {
        font-size: 3.5rem;
    }

    .facility-hero-content p {
        font-size: 1.15rem;
        opacity: 0.95;
        line-height: 1.8;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
        margin: 0;
    }

    .facility-header {
        display: none;
    }

    .facility-banner {
        display: none;
    }

    .facility-description {
        background: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 60px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .facility-description p {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #6b7280;
        margin: 0;
    }

    .facility-items-section h2 {
        font-size: 2.2rem;
        color: var(--dark-color);
        margin-bottom: 40px;
        font-weight: 700;
    }

    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }

    .item-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 5px solid var(--primary-color);
        overflow: hidden;
    }

    .item-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        border-left-color: var(--accent-color);
    }

    .item-image {
        width: 100%;
        height: 200px;
        border-radius: 8px;
        object-fit: cover;
        margin-bottom: 15px;
        display: block;
    }

    .item-card h3 {
        color: var(--dark-color);
        font-size: 1.4rem;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .item-card p {
        color: #6b7280;
        font-size: 1rem;
        line-height: 1.7;
        margin: 0;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 60px 40px;
        border-radius: 15px;
        text-align: center;
    }

    .cta-section h2 {
        color: white;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .cta-section p {
        font-size: 1.05rem;
        opacity: 0.95;
        margin-bottom: 30px;
    }

    .btn-cta {
        background: white;
        color: var(--primary-color);
        padding: 14px 35px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        display: inline-block;
        transition: all 0.3s ease;
        margin: 0 10px;
    }

    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: var(--primary-color);
    }

    .breadcrumb-nav {
        margin-bottom: 40px;
        padding: 15px 0;
    }

    .breadcrumb-nav a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        margin: 0 10px;
    }

    .breadcrumb-nav a:hover {
        color: var(--secondary-color);
    }

    .breadcrumb-nav span {
        color: #6b7280;
        margin: 0 5px;
    }

    @media (max-width: 768px) {
        .facility-hero-banner {
            height: 350px;
            margin-bottom: 40px;
        }

        .facility-hero-content h1 {
            font-size: 2rem;
            flex-direction: column;
            gap: 15px;
        }

        .facility-hero-content h1 i {
            font-size: 2rem;
        }

        .facility-hero-content p {
            font-size: 0.95rem;
        }

        .facility-hero-content {
            padding: 30px;
        }

        .facility-description {
            padding: 25px;
        }

        .items-grid {
            grid-template-columns: 1fr;
        }

        .item-card {
            padding: 20px;
        }

        .cta-section {
            padding: 40px 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-lg">
    {{-- Breadcrumb --}}
    <div class="breadcrumb-nav">
        <a href="{{ route('about') }}"><i class="fas fa-home"></i> Tentang Kami</a>
        <span><i class="fas fa-chevron-right"></i></span>
        <span style="color: var(--primary-color); font-weight: 600;">{{ $facility->title }}</span>
    </div>

    {{-- Hero Banner --}}
    <div class="facility-hero-banner" style="background-image: url('{{ $facility->banner ? asset('storage/' . $facility->banner) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1200&h=600&fit=crop' }}');">
        <div class="facility-hero-overlay"></div>
        <div class="facility-hero-content">
            <h1>
                <i class="{{ $facility->icon }}"></i>
                {{ $facility->title }}
            </h1>
            <p>{{ $facility->description }}</p>
        </div>
    </div>

    {{-- Hidden elements (kept for backward compatibility) --}}
    <div class="facility-header" style="display: none;"></div>
    <img src="" alt="" class="facility-banner" style="display: none;">

    {{-- Description Section (now optional/hidden since it's in hero) --}}

    {{-- Items Section --}}
    <section class="facility-items-section">
        <h2><i class="fas fa-list-ul"></i> Daftar {{ $facility->title }}</h2>

        @if($facility->facilityItems->count() > 0)
            <div class="items-grid">
                @foreach($facility->facilityItems as $item)
                    <div class="item-card">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="item-image">
                        @else
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=500&h=300&fit=crop" alt="{{ $item->name }}" class="item-image">
                        @endif
                        <h3>{{ $item->name }}</h3>
                        <p>{{ $item->description }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div style="background: #f8fafc; padding: 40px; border-radius: 12px; text-align: center; color: #9ca3af;">
                <i class="fas fa-inbox" style="font-size: 2.5rem; margin-bottom: 15px; display: block;"></i>
                <p style="margin: 0;">Belum ada item yang tersedia untuk fasilitas ini.</p>
            </div>
        @endif
    </section>

    {{-- CTA Section --}}
    <div class="cta-section" style="margin-top: 80px;">
        <h2><i class="fas fa-handshake"></i> Tertarik dengan Fasilitas Kami?</h2>
        <p>Hubungi tim kami untuk informasi lebih lanjut tentang {{ $facility->title }}</p>
        <div>
            <a href="{{ route('properties.hunian') }}" class="btn-cta">
                <i class="fas fa-home"></i> Lihat Properti
            </a>
            <a href="{{ route('kontak') }}" class="btn-cta">
                <i class="fas fa-phone"></i> Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection

@extends('frontend.layouts.app')

@section('title', 'Tentang Kami - Properti Kotabaru')

@section('styles')
<style>
    .about-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 80px 30px;
        text-align: center;
        margin-bottom: 60px;
        border-radius: 12px;
    }

    .about-header h1 {
        font-size: 2.8rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .about-header p {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .about-section {
        margin: 80px 0;
    }

    .about-section h2 {
        font-size: 2.2rem;
        margin-bottom: 40px;
        color: var(--dark-color);
        font-weight: 600;
    }

    .about-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }

    .about-image {
        width: 100%;
        height: 350px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .about-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .about-text p {
        font-size: 1rem;
        line-height: 1.8;
        color: #6b7280;
        margin-bottom: 15px;
    }

    /* Facilities Grid */
    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-bottom: 50px;
    }

    .facility-card {
        background: white;
        padding: 28px 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 15px;
        cursor: pointer;
        border: none;
        text-align: left;
    }

    .facility-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .facility-card:active {
        transform: translateY(-2px);
    }

    .facility-icon {
        font-size: 2.2rem;
        color: #1f2937;
        flex-shrink: 0;
    }

    .facility-content {
        flex: 1;
    }

    .facility-title {
        color: #000;
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
    }

    .facility-arrow {
        color: #1f2937;
        font-size: 0.9rem;
        flex-shrink: 0;
        opacity: 0.6;
    }

    /* Section Styles */
    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 60px 40px;
        border-radius: 15px;
        text-align: center;
        margin: 80px 0;
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

    @media (max-width: 768px) {
        .about-header h1 {
            font-size: 2rem;
        }

        .about-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .about-image {
            height: 250px;
        }

        .facilities-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .facility-card {
            padding: 20px 15px;
        }

        .facility-icon {
            font-size: 1.8rem;
        }

        .facility-title {
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-lg">
    {{-- Header --}}
    <div class="about-header">
        <h1><i class="fas fa-city"></i> Kota Baru Parahyangan</h1>
        <p>Kota Mandiri Berwawasan Pendidikan</p>
    </div>

    {{-- Tentang Kami Section --}}
    @if($about)
    <section class="about-section">
        <h2><i class="fas fa-info-circle"></i> {{ $about->section_title }}</h2>
        <div class="about-content">
            @if($about->image_path)
            <div class="about-image">
                <img src="{{ Storage::url($about->image_path) }}" alt="{{ $about->section_title }}">
            </div>
            @else
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1449844908441-8829872d2607?w=500&h=400&fit=crop" alt="Kota Baru Parahyangan">
            </div>
            @endif
            <div class="about-text">
                <p>{{ $about->description }}</p>
            </div>
        </div>
    </section>

    {{-- Visi & Misi Section --}}
    <section class="about-section">
        <h2><i class="fas fa-star"></i> {{ $about->vision_title }}</h2>
        <div class="about-content">
            <div class="about-image">
                @if($about->vision_mission_image)
                    <img src="{{ Storage::url($about->vision_mission_image) }}" alt="Visi Kami">
                @else
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=500&h=400&fit=crop" alt="Visi Kami">
                @endif
            </div>
            <div class="about-text">
                <h3 style="color: var(--dark-color); margin-bottom: 15px; font-size: 1.3rem; font-weight: 600;">Visi</h3>
                <div style="color: #6b7280; line-height: 1.7; margin-bottom: 25px;">
                    {!! nl2br(e($about->vision_content)) !!}
                </div>
                <h3 style="color: var(--dark-color); margin-bottom: 15px; font-size: 1.3rem; font-weight: 600;">Misi</h3>
                <p style="color: #6b7280; line-height: 1.8;">{{ $about->mission_content }}</p>
            </div>
        </div>
    </section>
    @endif

    {{-- Fasilitas Publik Section --}}
    <section class="about-section">
        <h2 style="text-align: center;"><i class="fas fa-building"></i> Fasilitas Publik Tersedia</h2>
        <div class="facilities-grid">
            @forelse($facilities as $facility)
                <a href="{{ route('facility.show', $facility->slug) }}" class="facility-card" style="text-decoration: none; color: inherit;">
                    <i class="facility-icon {{ $facility->icon }}"></i>
                    <div class="facility-content">
                        <h4 class="facility-title">{{ $facility->title }}</h4>
                    </div>
                    <i class="facility-arrow fas fa-arrow-right"></i>
                </a>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #9ca3af;">
                    <p><i class="fas fa-info-circle"></i> Fasilitas sedang diperbarui</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- CTA Section --}}
    <div class="cta-section">
        <h2><i class="fas fa-handshake"></i> Tertarik Bekerja Sama Dengan Kami?</h2>
        <p>Hubungi tim kami untuk konsultasi gratis atau penawaran spesial</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('properties.hunian') }}" class="btn btn-light" style="padding: 12px 35px; font-weight: 600;">
                <i class="fas fa-home"></i> Cari Properti
            </a>
            <button class="btn btn-outline-light" style="padding: 12px 35px; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#contactModal">
                <i class="fas fa-phone"></i> Hubungi Kami
            </button>
        </div>
    </div>
</div>
@endsection

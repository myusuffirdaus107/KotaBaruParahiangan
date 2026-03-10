@extends('frontend.layouts.app')

@section('title', 'Hunian - Properti Kotabaru')

@section('styles')
<style>
    .hunian-section {
        padding: 80px 0;
    }

    .hunian-item {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        margin-bottom: 100px;
        padding: 0 20px;
    }

    .hunian-item.reverse {
        direction: rtl;
    }

    .hunian-item.reverse > * {
        direction: ltr;
    }

    .hunian-image {
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .hunian-image img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .hunian-image:hover img {
        transform: scale(1.05);
    }

    .hunian-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: #1a5a7f;
        margin-bottom: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .hunian-content p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 30px;
        text-align: justify;
    }

    .hunian-cta {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #22a047;
        color: white;
        padding: 16px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #22a047;
        font-size: 1.05rem;
    }

    .hunian-cta:hover {
        background: white;
        color: #22a047;
        box-shadow: 0 8px 20px rgba(34, 160, 71, 0.3);
    }

    .hunian-cta i {
        font-size: 1.2rem;
    }

    @media (max-width: 768px) {
        .hunian-item {
            grid-template-columns: 1fr;
            gap: 30px;
            margin-bottom: 60px;
            padding: 0;
        }

        .hunian-item.reverse {
            direction: ltr;
        }

        .hunian-content h2 {
            font-size: 1.8rem;
        }

        .hunian-content p {
            font-size: 1rem;
        }

        .hunian-image img {
            height: 300px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-lg">
    <div class="hunian-section">
        @forelse($properties as $property)
            <div class="hunian-item {{ $loop->odd ? '' : 'reverse' }}">
                <div class="hunian-image">
                    @if($property->images->count() > 0)
                        <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&h=450&fit=crop" alt="{{ $property->title }}">
                    @endif
                </div>
                <div class="hunian-content">
                    <h2>TATAR {{ strtoupper($property->title) }}</h2>
                    <p>{{ $property->description ?? $property->title }}</p>
                    <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20{{ urlencode($property->title) }}" target="_blank" class="hunian-cta">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 100px 20px;">
                <i class="fas fa-search" style="font-size: 4rem; color: #cbd5e1; margin-bottom: 20px; display: block;"></i>
                <h3 style="color: #1a5a7f; margin-bottom: 10px;">Hunian Tidak Ditemukan</h3>
                <p style="color: #9ca3af; font-size: 1.05rem;">Maaf, tidak ada data hunian yang tersedia saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

@extends('frontend.layouts.app')

@section('title', 'Business - Properti Kotabaru')

@section('styles')
<style>
    .business-section {
        padding: 0;
        margin: 0;
    }

    .business-item {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 0;
        align-items: stretch;
        min-height: 500px;
        margin: 0;
    }

    .business-item:nth-child(odd) {
        background: #1a5a7f;
    }

    .business-item:nth-child(even) {
        background: #2a7baa;
    }

    /* Reverse layout untuk alternating */
    .business-item:nth-child(even) {
        direction: rtl;
    }

    .business-item:nth-child(even) > * {
        direction: ltr;
    }

    .business-content {
        padding: 60px 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: white;
    }

    .business-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 700;
        margin: 0 0 15px 0;
        letter-spacing: 1px;
        line-height: 1.1;
    }

    .business-content h3 {
        font-size: 1.6rem;
        font-weight: 400;
        margin: 0 0 35px 0;
        opacity: 0.95;
        letter-spacing: 0.5px;
    }

    .business-description {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 35px;
    }

    .business-description p {
        font-size: 1.1rem;
        line-height: 1.75;
        margin: 0;
        opacity: 0.92;
        text-align: justify;
    }

    .business-image {
        overflow: hidden;
        height: 100%;
    }

    .business-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .business-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: #d4af37;
        color: #1a5a7f;
        padding: 14px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 650;
        transition: all 0.3s ease;
        border: none;
        font-size: 1rem;
        width: fit-content;
    }

    .business-cta:hover {
        background: white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    .business-cta i {
        font-size: 1.1rem;
    }

    @media (max-width: 1200px) {
        .business-item {
            grid-template-columns: 1fr 1fr;
            min-height: 450px;
        }

        .business-content {
            padding: 50px 60px;
        }

        .business-content h2 {
            font-size: 2.5rem;
        }

        .business-content h3 {
            font-size: 1.4rem;
        }

        .business-content p {
            font-size: 1rem;
        }
    }

    @media (max-width: 992px) {
        .business-item {
            grid-template-columns: 1fr;
            min-height: auto;
        }

        .business-item:nth-child(even) {
            direction: ltr;
        }

        .business-content {
            padding: 40px 30px;
        }

        .business-content h2 {
            font-size: 2rem;
        }

        .business-content h3 {
            font-size: 1.2rem;
        }

        .business-image {
            height: 350px;
        }
    }

    @media (max-width: 768px) {
        .business-content {
            padding: 30px 20px;
        }

        .business-content h2 {
            font-size: 1.6rem;
        }

        .business-content h3 {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .business-description p {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .business-image {
            height: 280px;
        }
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 100px 20px;
        background: #f8fafc;
        min-height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #1a5a7f;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #9ca3af;
        font-size: 1.05rem;
    }
</style>
@endsection

@section('content')
<div class="business-section">
    @forelse($properties as $property)
        <div class="business-item">
            <div class="business-content">
                <h2>{{ strtoupper($property->title) }}</h2>
                <h3>{{ $property->category->name ?? 'Business Property' }}</h3>
                
                <div class="business-description">
                    @php
                        $descriptions = [];
                        if ($property->description) {
                            $descriptions = array_filter(array_map('trim', explode('\n', $property->description)));
                        }
                        
                        if (count($descriptions) < 2) {
                            $descriptions = [
                                'Presenting a solution to the need for a Representative Office Space, ' . $property->title . ' Business Loft offers three-floor office units with a lot width of 7 -7.5 meters, featuring an Elegant Modern Façade and an Open Interior Layout that can be easily adapted to suit various business needs.',
                                'A limited number of units are available in a strategic location to maintain Exclusivity and Long-Term Property Value. An ideal choice for both Business Owners and Investors to elevate their Business Image while enjoying the growth of Property Investment.'
                            ];
                            if ($loop->iteration % 3 == 0) {
                                $descriptions[] = 'Space Flexibility. There is a communal area with a passenger lift and common stairs, allowing each unit on every floor to accommodate multiple users independently';
                                $descriptions[] = 'The layout design presents a High Ceiling - Common Space at the front of the office unit, creating a Luxurious Impression on both the façade and the interior. The application of a Curtain Wall system for the façade finishing further enhances The Professional Image of the office units.';
                            }
                        }
                    @endphp
                    
                    @foreach(array_slice($descriptions, 0, 3) as $desc)
                        <p>{{ $desc }}</p>
                    @endforeach
                </div>

                <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20{{ urlencode($property->title) }}" target="_blank" class="business-cta">
                    <i class="fas fa-file-pdf"></i>
                    E-Brochure
                </a>
            </div>

            <div class="business-image">
                @if($property->images->count() > 0)
                    <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}">
                @else
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&h=500&fit=crop" alt="{{ $property->title }}">
                @endif
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="fas fa-search"></i>
            <h3>Business Properties Tidak Ditemukan</h3>
            <p>Maaf, tidak ada data properti bisnis yang tersedia saat ini.</p>
        </div>
    @endforelse
</div>
@endsection


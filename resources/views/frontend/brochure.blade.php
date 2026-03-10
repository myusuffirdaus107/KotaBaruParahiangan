@extends('frontend.layouts.app')

@section('title', 'E-Brochure - Properti Kotabaru')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 60px 30px;
        margin-bottom: 50px;
        border-radius: 10px;
    }
    
    .page-header h1 {
        color: white;
        font-size: 2.8rem;
        margin-bottom: 10px;
    }
    
    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 40px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .filter-section label {
        color: var(--dark-color);
        font-weight: 600;
        margin-bottom: 0;
    }
    
    .filter-section select {
        padding: 8px 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        flex: 1;
        min-width: 200px;
    }
    
    @media (max-width: 768px) {
        .filter-section {
            flex-direction: column;
        }
        
        .filter-section label {
            width: 100%;
            margin-bottom: 5px;
        }
        
        .filter-section select {
            width: 100%;
        }
    }
    
    .brochure-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }
    
    @media (max-width: 768px) {
        .brochure-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .brochure-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .brochure-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }
    
    .brochure-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        overflow: hidden;
        position: relative;
    }
    
    .brochure-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .brochure-card:hover .brochure-image img {
        transform: scale(1.05);
    }
    
    .brochure-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, var(--secondary-color) 0%, #3b82f6 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .brochure-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .brochure-content h3 {
        color: var(--dark-color);
        margin-bottom: 8px;
        font-size: 1.25rem;
        line-height: 1.4;
    }
    
    .brochure-category {
        display: inline-block;
        background-color: #f3f4f6;
        color: #6b7280;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 12px;
    }
    
    .brochure-description {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 15px;
        flex-grow: 1;
        line-height: 1.5;
    }
    
    .brochure-meta {
        display: flex;
        gap: 15px;
        padding-top: 15px;
        border-top: 1px solid var(--border-color);
        margin-bottom: 15px;
        font-size: 0.9rem;
        color: #9ca3af;
    }
    
    .brochure-meta i {
        color: var(--secondary-color);
    }
    
    .brochure-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn-download {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(30, 58, 138, 0.3);
        color: white;
    }
    
    .btn-detail {
        flex: 1;
        background-color: white;
        color: var(--secondary-color);
        border: 2px solid var(--secondary-color);
        padding: 8px 15px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-detail:hover {
        background-color: var(--secondary-color);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 80px 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        color: var(--dark-color);
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #9ca3af;
    }
    
    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 60px 30px;
        border-radius: 12px;
        text-align: center;
        margin-top: 60px;
    }
    
    .cta-section h2 {
        color: white;
        margin-bottom: 15px;
    }
    
    .cta-section p {
        opacity: 0.9;
        margin-bottom: 30px;
        font-size: 1.05rem;
    }
    
    .cta-form {
        display: flex;
        gap: 10px;
        max-width: 500px;
        margin: 0 auto;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .cta-form input {
        flex: 1;
        min-width: 200px;
        padding: 12px 15px;
        border: none;
        border-radius: 6px;
        font-size: 0.95rem;
    }
    
    .cta-form button {
        padding: 12px 30px;
        background: white;
        color: var(--primary-color);
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .cta-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }
    
    @media (max-width: 568px) {
        .cta-form {
            flex-direction: column;
        }
        
        .cta-form input {
            width: 100%;
        }
        
        .cta-form button {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container-lg">
    {{-- Page Header --}}
    <div class="page-header">
        <h1><i class="fas fa-file-pdf"></i> E-Brochure</h1>
        <p>Unduh brosur lengkap properti pilihan Anda dengan informasi detail dan penawaran khusus</p>
    </div>

    {{-- Filter Section --}}
    <div class="filter-section">
        <label for="category-filter"><i class="fas fa-filter"></i> Filter Kategori:</label>
        <select id="category-filter" class="form-select" onchange="filterBrochures(this.value)">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Brochures Grid --}}
    @if($properties->count() > 0)
        <div class="brochure-grid" id="brochure-grid">
            @foreach($properties as $property)
                <div class="brochure-card" data-category="{{ $property->category_id }}">
                    <div class="brochure-image">
                        @if($property->propertyImages->first())
                            <img src="{{ asset('storage/' . $property->propertyImages->first()->image_path) }}" 
                                 alt="{{ $property->title }}" 
                                 onerror="this.src='https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=500&h=300&fit=crop'">
                        @else
                            <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=500&h=300&fit=crop" 
                                 alt="{{ $property->title }}">
                        @endif
                        <span class="brochure-badge">
                            <i class="fas fa-file-pdf"></i> Brosur Tersedia
                        </span>
                    </div>
                    
                    <div class="brochure-content">
                        <span class="brochure-category">{{ $property->category->name }}</span>
                        
                        <h3>{{ $property->title }}</h3>
                        
                        <p class="brochure-description">{{ Str::limit($property->description, 100) }}</p>
                        
                        <div class="brochure-meta">
                            <span><i class="fas fa-map-marker-alt"></i> Lokasi</span>
                            <span><i class="fas fa-layer-group"></i> 
                                @if($property->bedrooms){{ $property->bedrooms }} Kamar@endif
                            </span>
                        </div>
                        
                        <div class="brochure-actions">
                            <a href="#" class="btn-download" title="Download Brosur">
                                <i class="fas fa-cloud-download-alt"></i> Download
                            </a>
                            <a href="{{ route('properties.detail', $property->id) }}" 
                               class="btn-detail" title="Lihat Detail">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Belum Ada Brosur Tersedia</h3>
            <p>Mohon maaf, saat ini belum ada brosur properti yang tersedia untuk diunduh.<br>
            Silakan periksa kembali lagi nanti atau hubungi kami untuk informasi lebih lanjut.</p>
            <a href="{{ route('kontak') }}" class="btn btn-primary mt-4">
                <i class="fas fa-phone-alt"></i> Hubungi Kami
            </a>
        </div>
    @endif

    {{-- CTA Section --}}
    <div class="cta-section">
        <h2><i class="fas fa-bell"></i> Dapatkan Update Brosur Terbaru</h2>
        <p>Berlangganan untuk menerima informasi tentang brosur properti terbaru dan penawaran eksklusif</p>
        <form class="cta-form" onsubmit="handleSubscribe(event)">
            <input type="email" placeholder="Masukkan email Anda" required>
            <button type="submit"><i class="fas fa-envelope"></i> Berlangganan</button>
        </form>
    </div>
</div>

<script>
function filterBrochures(categoryId) {
    const cards = document.querySelectorAll('.brochure-card');
    
    cards.forEach(card => {
        if (!categoryId) {
            card.style.display = 'flex';
        } else if (card.dataset.category === categoryId) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function handleSubscribe(event) {
    event.preventDefault();
    alert('Terima kasih! Anda telah berhasil berlangganan untuk menerima update brosur terbaru.');
    event.target.reset();
}
</script>
@endsection

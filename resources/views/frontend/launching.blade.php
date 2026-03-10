@extends('frontend.layouts.app')

@section('title', 'Launching Terbaru - Properti Kotabaru')

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
    
    .launching-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }
    
    .launching-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
    }
    
    .launching-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(30, 58, 138, 0.15);
    }
    
    .launching-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }
    
    .launching-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .launching-card:hover .launching-image img {
        transform: scale(1.1);
    }
    
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    
    .status-badge.coming-soon {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }
    
    .launching-body {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .launching-body h3 {
        color: var(--dark-color);
        font-size: 1.3rem;
        margin-bottom: 10px;
    }
    
    .launching-body p {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 15px;
        flex: 1;
    }
    
    .launching-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        padding-top: 15px;
        border-top: 1px solid var(--border-color);
    }
    
    .meta-item {
        color: #9ca3af;
        font-size: 0.9rem;
    }
    
    .meta-item i {
        color: var(--accent-color);
        margin-right: 5px;
    }
    
    .btn-view-launching {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-view-launching:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(30, 58, 138, 0.3);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 80px 30px;
        background: #f8fafc;
        border-radius: 12px;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        color: var(--dark-color);
    }
    
    .empty-state p {
        color: #9ca3af;
    }
</style>
@endsection

@section('content')
<div class="container-lg">
    {{-- Page Header --}}
    <div class="page-header">
        <h1><i class="fas fa-rocket"></i> Launching Terbaru</h1>
        <p>Temukan proyek properti terbaru dengan inovasi dan kualitas terbaik</p>
    </div>

    {{-- Launching Grid --}}
    @if($launchings->count() > 0)
        <div class="launching-grid">
            @foreach($launchings as $launching)
                <div class="launching-card">
                    <div class="launching-image position-relative">
                        <img src="{{ asset('storage/' . $launching->image) }}" alt="{{ $launching->title }}">
                        <div class="status-badge {{ $launching->status === 'coming_soon' ? 'coming-soon' : '' }}">
                            @if($launching->status === 'coming_soon')
                                <i class="fas fa-hourglass-end"></i> Segera Hadir
                            @else
                                <i class="fas fa-check-circle"></i> Tersedia
                            @endif
                        </div>
                    </div>
                    <div class="launching-body">
                        <h3>{{ $launching->title }}</h3>
                        <p>{{ $launching->description }}</p>
                        
                        <div class="launching-meta">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i> 
                                {{ $launching->created_at->format('M Y') }}
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $launching->created_at->diffForHumans() }}
                            </div>
                        </div>
                        
                        <a href="{{ route('home') }}" class="btn-view-launching">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($launchings->hasPages())
            <div class="d-flex justify-content-center mb-5">
                {{ $launchings->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Belum Ada Launching</h3>
            <p>Saat ini belum ada proyek launching yang tersedia. Silahkan cek kembali nanti.</p>
        </div>
    @endif

    {{-- CTA Section --}}
    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); 
                padding: 60px 30px; border-radius: 15px; text-align: center; color: white; margin: 60px 0;">
        <h2 style="color: white; margin-bottom: 20px;">Ingin Mengetahui Update Launching Terbaru?</h2>
        <p style="font-size: 1.1rem; margin-bottom: 30px; opacity: 0.95;">
            Daftarkan email Anda untuk mendapatkan notifikasi launching proyek terbaru
        </p>
        <form class="d-flex gap-3 justify-content-center flex-wrap" style="max-width: 600px; margin: 0 auto;">
            <input type="email" class="form-control" placeholder="Masukkan email Anda..." required style="border-radius: 6px;">
            <button type="submit" class="btn" style="background: var(--accent-color); color: white; font-weight: 600; padding: 12px 35px; border: none; border-radius: 6px; white-space: nowrap;">
                <i class="fas fa-bell"></i> Subscribe
            </button>
        </form>
    </div>
</div>
@endsection

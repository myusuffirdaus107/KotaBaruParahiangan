@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- STAT CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-home"></i></div>
            <div class="stat-body">
                <div class="stat-label">Total Properties</div>
                <div class="stat-num blue">{{ $totalProperties }}</div>
                <div class="stat-trend"><i class="fas fa-layer-group me-1"></i>Properti aktif</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fas fa-envelope"></i></div>
            <div class="stat-body">
                <div class="stat-label">Inquiries Baru</div>
                <div class="stat-num gold">{{ $totalInquiries }}</div>
                <div class="stat-trend"><i class="fas fa-clock me-1"></i>Menunggu respons</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-images"></i></div>
            <div class="stat-body">
                <div class="stat-label">Total Sliders</div>
                <div class="stat-num green">{{ $totalSliders }}</div>
                <div class="stat-trend"><i class="fas fa-desktop me-1"></i>Slider Halaman Home</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-rocket"></i></div>
            <div class="stat-body">
                <div class="stat-label">Launching</div>
                <div class="stat-num purple">{{ $totalLaunching }}</div>
                <div class="stat-trend"><i class="fas fa-star me-1"></i>Produk baru</div>
            </div>
        </div>
    </div>
</div>

{{-- QUICK ACTIONS + RECENT INQUIRIES --}}
<div class="row g-3 mb-3">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <span class="card-header-icon"><i class="fas fa-bolt"></i></span>
                Quick Actions
            </div>
            <div class="card-body">
                <a href="{{ route('admin.properties.create') }}" class="action-btn">
                    <span class="ab-icon"><i class="fas fa-home"></i></span>
                    Tambah Property
                </a>
                <a href="{{ route('admin.sliders.create') }}" class="action-btn">
                    <span class="ab-icon"><i class="fas fa-images"></i></span>
                    Tambah Slider
                </a>
                <a href="{{ route('admin.categories.create') }}" class="action-btn">
                    <span class="ab-icon"><i class="fas fa-tags"></i></span>
                    Tambah Category
                </a>
                <a href="{{ route('admin.launchings.create') }}" class="action-btn">
                    <span class="ab-icon"><i class="fas fa-rocket"></i></span>
                    Tambah Launching
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <span class="card-header-icon"><i class="fas fa-envelope"></i></span>
                Inquiry Terbaru
                <a href="{{ route('admin.inquiries.index') }}" class="ms-auto" style="font-size:0.76rem; color:var(--blue2); font-weight:600; text-decoration:none;">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentInquiries->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="d-none d-md-table-cell">Telepon</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentInquiries as $inquiry)
                            <tr>
                                <td>
                                    <div style="font-weight:600; color:var(--navy);">{{ $inquiry->name }}</div>
                                    <div style="font-size:0.75rem; color:var(--muted);">{{ $inquiry->email }}</div>
                                </td>
                                <td class="d-none d-md-table-cell" style="color:var(--muted);">{{ $inquiry->phone }}</td>
                                <td>
                                    @if($inquiry->is_contacted)
                                        <span class="badge bg-success">Terhubung</span>
                                    @else
                                        <span class="badge bg-warning">Belum</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5" style="color:var(--muted);">
                    <i class="fas fa-inbox fa-2x mb-3 d-block" style="opacity:0.3;"></i>
                    Tidak ada inquiry saat ini
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- FEATURED PROPERTIES --}}
<div class="card">
    <div class="card-header">
        <span class="card-header-icon"><i class="fas fa-star"></i></span>
        Featured Properties
        <a href="{{ route('admin.properties.index') }}" class="ms-auto" style="font-size:0.76rem; color:var(--blue2); font-weight:600; text-decoration:none;">
            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        @if($featuredProperties->count() > 0)
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="width:72px;">Foto</th>
                        <th>Judul</th>
                        <th class="d-none d-md-table-cell">Kategori</th>
                        <th class="d-none d-lg-table-cell">Lokasi</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($featuredProperties as $property)
                    <tr>
                        {{-- FOTO --}}
                        <td>
                            @if($property->images->count() > 0)
                                <img src="{{ Storage::url($property->images->first()->image_path) }}"
                                     alt="{{ $property->title }}"
                                     style="width:56px; height:56px; object-fit:cover; border-radius:9px; border:1px solid var(--border);">
                            @else
                                <div style="width:56px; height:56px; border-radius:9px; background:var(--bg); border:1px solid var(--border); display:grid; place-items:center; color:var(--muted);">
                                    <i class="fas fa-image" style="opacity:0.35;"></i>
                                </div>
                            @endif
                        </td>

                        {{-- JUDUL --}}
                        <td>
                            <div style="font-weight:700; color:var(--navy);">{{ $property->title }}</div>
                            <div class="d-md-none" style="font-size:0.75rem; color:var(--muted);">{{ $property->category->name ?? '-' }}</div>
                        </td>

                        {{-- KATEGORI --}}
                        <td class="d-none d-md-table-cell">
                            <span style="font-size:0.78rem; background:rgba(37,150,190,0.08); color:var(--blue2); padding:3px 10px; border-radius:100px; font-weight:600;">
                                {{ $property->category->name ?? '-' }}
                            </span>
                        </td>

                        {{-- LOKASI --}}
                        <td class="d-none d-lg-table-cell" style="color:var(--muted); font-size:0.82rem;">
                            <i class="fas fa-map-marker-alt me-1" style="color:var(--blue2);"></i>
                            {{ Str::limit($property->location, 30) }}
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($property->status === 'available')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Sold Out</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5" style="color:var(--muted);">
            <i class="fas fa-home fa-2x mb-3 d-block" style="opacity:0.3;"></i>
            Tidak ada featured properties
        </div>
        @endif
    </div>
</div>

@endsection
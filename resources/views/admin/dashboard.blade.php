@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    {{-- Stats Cards --}}
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <h5><i class="fas fa-home"></i> Total Properties</h5>
            <div class="number">{{ $totalProperties }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card" style="border-left-color: #f59e0b;">
            <h5><i class="fas fa-envelope"></i> Inquiries Baru</h5>
            <div class="number" style="color: #f59e0b;">{{ $totalInquiries }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card" style="border-left-color: #10b981;">
            <h5><i class="fas fa-image"></i> Total Sliders</h5>
            <div class="number" style="color: #10b981;">{{ $totalSliders }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card" style="border-left-color: #8b5cf6;">
            <h5><i class="fas fa-rocket"></i> Launching</h5>
            <div class="number" style="color: #8b5cf6;">{{ $totalLaunching }}</div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Quick Actions --}}
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-bolt"></i> Quick Actions
            </div>
            <div class="card-body">
                <a href="{{ route('admin.properties.create') }}" class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-plus"></i> Tambah Property
                </a>
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-plus"></i> Tambah Slider
                </a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-plus"></i> Tambah Category
                </a>
                <a href="{{ route('admin.launchings.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-plus"></i> Tambah Launching
                </a>
            </div>
        </div>
    </div>
    
    {{-- Recent Inquiries --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-envelope"></i> Inquiry Terbaru
            </div>
            <div class="card-body">
                @if($recentInquiries->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentInquiries as $inquiry)
                                <tr>
                                    <td><strong>{{ $inquiry->name }}</strong></td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td>{{ $inquiry->phone }}</td>
                                    <td>
                                        @if($inquiry->is_contacted)
                                            <span class="badge bg-success">Terhubung</span>
                                        @else
                                            <span class="badge bg-warning">Belum</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted py-4">Tidak ada inquiry belum</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    {{-- Featured Properties --}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-star"></i> Featured Properties
            </div>
            <div class="card-body">
                @if($featuredProperties->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Category</th>
                                    <th>Lokasi</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($featuredProperties as $property)
                                <tr>
                                    <td><strong>{{ $property->title }}</strong></td>
                                    <td>{{ $property->category->name ?? '-' }}</td>
                                    <td>{{ $property->location }}</td>
                                    <td>
                                        @if($property->price_from)
                                            Rp {{ number_format($property->price_from, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($property->is_available)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted py-4">Tidak ada featured properties</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Properties - Admin')
@section('page-title', 'Kelola Properties')

@section('content')

{{-- HEADER ACTION --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
        <p style="color:var(--muted); font-size:0.84rem; margin:0;">
            Total <strong style="color:var(--navy);">{{ $properties->total() }}</strong> properti ditemukan
        </p>
    </div>
    <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Property
    </a>
</div>

{{-- FILTER CARD --}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.properties.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label">Cari Property</label>
                    <div style="position:relative;">
                        <i class="fas fa-search" style="position:absolute; left:13px; top:50%; transform:translateY(-50%); color:var(--muted); font-size:0.8rem;"></i>
                        <input type="text" name="search" class="form-control" placeholder="Cari judul atau lokasi..."
                            value="{{ request('search') }}" style="padding-left:36px;">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-search me-1"></i> Filter
                        </button>
                        @if(request('search') || request('category_id'))
                        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- PROPERTIES TABLE --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="width:80px;">Foto</th>
                        <th>Properti</th>
                        <th class="d-none d-md-table-cell">Kategori</th>
                        <th class="d-none d-lg-table-cell">Lokasi</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                    <tr>
                        {{-- FOTO --}}
                        <td>
                            @if($property->images->count() > 0)
                                <img src="{{ Storage::url($property->images->first()->image_path) }}"
                                     alt="{{ $property->title }}"
                                     style="width:64px; height:64px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                            @else
                                <div style="width:64px; height:64px; border-radius:10px; background:var(--bg); border:1px solid var(--border); display:grid; place-items:center; color:var(--muted);">
                                    <i class="fas fa-image" style="font-size:1.2rem; opacity:0.4;"></i>
                                </div>
                            @endif
                        </td>

                        {{-- JUDUL --}}
                        <td>
                            <div style="font-weight:700; color:var(--navy); margin-bottom:2px;">{{ $property->title }}</div>
                            <div class="d-md-none" style="font-size:0.75rem; color:var(--muted);">
                                {{ $property->category->name ?? '-' }}
                            </div>
                            <div class="d-lg-none d-none d-md-block" style="font-size:0.75rem; color:var(--muted);">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($property->location, 30) }}
                            </div>
                        </td>

                        {{-- KATEGORI --}}
                        <td class="d-none d-md-table-cell">
                            <span style="font-size:0.8rem; background:rgba(37,150,190,0.08); color:var(--blue2); padding:3px 10px; border-radius:100px; font-weight:600;">
                                {{ $property->category->name ?? '-' }}
                            </span>
                        </td>

                        {{-- LOKASI --}}
                        <td class="d-none d-lg-table-cell" style="color:var(--muted); font-size:0.83rem;">
                            <i class="fas fa-map-marker-alt me-1" style="color:var(--blue2);"></i>
                            {{ Str::limit($property->location, 35) }}
                        </td>

                        {{-- FEATURED --}}
                        <td>
                            @if($property->featured)
                                <span class="badge bg-success"><i class="fas fa-star me-1"></i>Ya</span>
                            @else
                                <span class="badge" style="background:var(--bg); color:var(--muted);">Tidak</span>
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($property->status === 'available')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Tidak</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.properties.edit', $property) }}"
                                   class="btn btn-sm btn-secondary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.properties.destroy', $property) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus properti ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="text-center py-5" style="color:var(--muted);">
                                <i class="fas fa-home fa-2x mb-3 d-block" style="opacity:0.25;"></i>
                                Tidak ada properties ditemukan
                                @if(request('search') || request('category_id'))
                                    <div class="mt-2">
                                        <a href="{{ route('admin.properties.index') }}" style="color:var(--blue2); font-size:0.84rem;">
                                            Reset filter
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- PAGINATION --}}
@if($properties->hasPages())
<div class="mt-4 d-flex justify-content-center">
    {{ $properties->links() }}
</div>
@endif

@endsection
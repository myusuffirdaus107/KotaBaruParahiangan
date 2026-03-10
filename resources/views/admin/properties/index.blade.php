@extends('admin.layouts.app')

@section('title', 'Properties - Admin')
@section('page-title', 'Kelola Properties')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Property Baru
    </a>
</div>

{{-- Filters --}}
<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('admin.properties.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari judul atau lokasi..."
                    value="{{ request('search') }}"
                >
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-secondary w-100">
                    <i class="fas fa-search"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 80px;">Gambar</th>
                <th>Judul</th>
                <th>Category</th>
                <th>Lokasi</th>
                <th>Featured</th>
                <th>Available</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($properties as $property)
            <tr>
                <td>
                    @if($property->images->count() > 0)
                        <img src="{{ Storage::url($property->images->first()->image_path) }}" alt="Property" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                    @else
                        <img src="https://via.placeholder.com/70x70?text=No+Image" alt="No Image" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                    @endif
                </td>
                <td><strong>{{ $property->title }}</strong></td>
                <td>{{ $property->category->name ?? '-' }}</td>
                <td>{{ substr($property->location, 0, 30) }}...</td>
                <td>
                    @if($property->is_featured)
                        <span class="badge bg-success">Ya</span>
                    @else
                        <span class="badge bg-secondary">Tidak</span>
                    @endif
                </td>
                <td>
                    @if($property->is_available)
                        <span class="badge bg-success">Ya</span>
                    @else
                        <span class="badge bg-danger">Tidak</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">Tidak ada properties</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div style="margin-top: 20px;">
    {{ $properties->links() }}
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Fasilitas Publik - Admin')
@section('page-title', 'Kelola Fasilitas Publik')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Fasilitas Baru
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-responsive">
    <table class="table w-100">
        <thead>
            <tr>
                <th class="col-1">Urutan</th>
                <th class="col-3">Judul</th>
                <th class="col-3">Banner</th>
                <th class="col-1">Items</th>
                <th class="col-1">Status</th>
                <th class="col-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($facilities as $facility)
            <tr>
                <td>{{ $facility->order }}</td>
                <td>
                    <strong>
                        @if($facility->icon)
                            <i class="{{ $facility->icon }}"></i>
                        @endif
                        {{ $facility->title }}
                    </strong>
                </td>
                <td>
                    @if($facility->banner)
                        <img src="{{ asset('storage/' . $facility->banner) }}" 
                            alt="banner"
                            style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                            onclick="window.open('{{ asset('storage/' . $facility->banner) }}', '_blank')">
                    @else
                        <span class="badge bg-warning">Belum ada</span>
                    @endif
                </td>
                <td>
                    <span class="badge bg-secondary">{{ $facility->facilityItems->count() }}</span>
                </td>
                <td>
                    @if($facility->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.facilities.edit', $facility) }}" class="btn btn-sm btn-primary" title="Edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.facilities.items', $facility) }}" class="btn btn-sm btn-info" title="Kelola Items">
                            <i class="fas fa-list"></i> Items
                        </a>
                        <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus fasilitas ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                    Belum ada fasilitas
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

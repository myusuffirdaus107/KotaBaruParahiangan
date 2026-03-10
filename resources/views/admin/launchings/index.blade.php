@extends('admin.layouts.app')

@section('title', 'Launchings - Admin')
@section('page-title', 'Kelola Launching Campaigns')

@section('content')

<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <a href="{{ route('admin.launchings.create') }}" class="btn btn-primary" style="border-radius: 6px;">
        <i class="fas fa-plus" style="margin-right: 8px;"></i> Tambah Launching Campaign
    </a>
    <span class="badge bg-info" style="font-size: 14px; padding: 8px 12px;">
        <i class="fas fa-list"></i> Total: {{ $launchings->total() }}
    </span>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 6px;">
    <i class="fas fa-check-circle"></i> <strong>Sukses!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card" style="border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 3px;">
    <div class="card-body" style="padding: 20px;">
        <form action="{{ route('admin.launchings.index') }}" method="GET" class="row g-2">
            <div class="col-md-8">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama, lokasi, atau developer..."
                    value="{{ request('search') }}"
                    style="border-radius: 6px; border: 1px solid #e2e8f0;"
                >
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-secondary w-100" style="border-radius: 6px;">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card" style="border-radius: 8px; border: 1px solid #e2e8f0;">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                <tr>
                    <th style="padding: 15px; font-weight: 600; width: 100px;">Gambar</th>
                    <th style="padding: 15px; font-weight: 600;">Nama Launching</th>
                    <th style="padding: 15px; font-weight: 600;">Developer</th>
                    <th style="padding: 15px; font-weight: 600;">Lokasi</th>
                    <th style="padding: 15px; font-weight: 600;">Tanggal Launch</th>
                    <th style="padding: 15px; font-weight: 600;">Status</th>
                    <th style="padding: 15px; font-weight: 600; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($launchings as $launching)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 12px; vertical-align: middle;">
                        @if($launching->image)
                            <img src="{{ Storage::url($launching->image) }}" alt="{{ $launching->title }}"
                                 style="width: 90px; height: 80px; object-fit: cover; border-radius: 6px;">
                        @else
                            <div style="width: 90px; height: 80px; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                <i class="fas fa-image" style="color: #9ca3af; font-size: 24px;"></i>
                            </div>
                        @endif
                    </td>

                    <td style="padding: 12px; vertical-align: middle;">
                        <strong style="color: #1f2937;">{{ $launching->title }}</strong><br>
                        <small style="color: #6b7280;">{{ $launching->slug }}</small>
                    </td>

                    <td style="padding: 12px; vertical-align: middle;">
                        {{ $launching->developer ?? '-' }}
                    </td>

                    <td style="padding: 12px; vertical-align: middle;">
                        <small>{{ substr($launching->location ?? '-', 0, 40) }}{{ strlen($launching->location ?? '') > 40 ? '...' : '' }}</small>
                    </td>

                    <td style="padding: 12px; vertical-align: middle;">
                        @if($launching->launch_date)
                            <span style="color: #374151;">{{ \Carbon\Carbon::parse($launching->launch_date)->format('d-m-Y') }}</span>
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                    </td>

                    <td style="padding: 12px; vertical-align: middle;">
                        @if($launching->status === 'active')
                            <span class="badge bg-success" style="padding: 6px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-check-circle"></i> Aktif
                            </span>
                        @else
                            <span class="badge bg-warning" style="padding: 6px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-clock"></i> Coming Soon
                            </span>
                        @endif
                    </td>

                    <td style="padding: 12px; vertical-align: middle; text-align: center;">
                        <div style="display: flex; gap: 6px; justify-content: center;">
                            <a href="{{ route('admin.launchings.edit', $launching) }}" class="btn btn-sm btn-primary" title="Edit"
                               style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 6px; padding: 0;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.launchings.destroy', $launching) }}" method="POST" style="display: inline-block;"
                                  onclick="return confirm('Yakin ingin menghapus launching ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                        style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 6px; padding: 0;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 40px; text-align: center; color: #9ca3af;">
                        <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                        <p style="margin: 0; font-size: 16px;">Tidak ada launching campaign.</p>
                        <p style="margin: 0; color: #6b7280;">
                            <a href="{{ route('admin.launchings.create') }}" style="color: #3b82f6; text-decoration: none;">Tambah yang pertama sekarang</a>
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 30px;">
    {{ $launchings->links() }}
</div>

<style>
    .table tbody tr:hover {
        background-color: #f9fafb;
    }
</style>

@endsection

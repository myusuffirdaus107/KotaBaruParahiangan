@extends('admin.layouts.app')

@section('title', 'Sliders - Admin')
@section('page-title', 'Kelola Sliders')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Slider Baru
    </a>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 100px;">Gambar</th>
                <th>Judul</th>
                <th>Subtitle</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sliders as $slider)
            <tr>
                <td>
                    @if($slider->image)
                        <img src="{{ Storage::url($slider->image) }}" alt="Slider" style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px;">
                    @else
                        <img src="https://via.placeholder.com/100x60?text=No+Image" alt="No Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px;">
                    @endif
                </td>
                <td><strong>{{ $slider->title }}</strong></td>
                <td>{{ substr($slider->subtitle ?? '-', 0, 50) }}</td>
                <td>
                    @if($slider->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Tidak Aktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" style="display: inline;">
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
                <td colspan="5" class="text-center text-muted py-4">Tidak ada sliders</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $sliders->links() }}
@endsection

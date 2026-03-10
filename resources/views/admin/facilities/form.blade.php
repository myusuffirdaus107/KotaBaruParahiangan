@extends('admin.layouts.app')

@section('title', (isset($facility) ? 'Edit' : 'Tambah') . ' Fasilitas - Admin')
@section('page-title', (isset($facility) ? 'Edit Fasilitas' : 'Tambah Fasilitas Baru'))

@section('content')
<a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($facility) ? route('admin.facilities.update', $facility) : route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($facility))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Judul Fasilitas *</label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title', $facility->title ?? '') }}"
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="icon" class="form-label">Icon (Font Awesome) *</label>
                        <input
                            type="text"
                            class="form-control @error('icon') is-invalid @enderror"
                            id="icon"
                            name="icon"
                            value="{{ old('icon', $facility->icon ?? '') }}"
                            placeholder="contoh: fas fa-home"
                            required
                        >
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Gunakan Font Awesome icons. Cek <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com</a></small>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Deskripsi *</label>
                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                    rows="4"
                    required
                >{{ old('description', $facility->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Deskripsi akan ditampilkan di hero banner pada halaman detail</small>
            </div>

            <div class="form-group mb-3">
                <label for="banner" class="form-label">Banner Image (JPG, PNG, GIF - Max 2MB)</label>
                <input
                    type="file"
                    class="form-control @error('banner') is-invalid @enderror"
                    id="banner"
                    name="banner"
                    accept="image/jpeg,image/png,image/gif"
                >
                @error('banner')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if(isset($facility) && $facility->banner)
                    <div style="margin-top: 15px;">
                        <small class="form-text text-muted d-block mb-2">Banner Saat Ini:</small>
                        <img src="{{ asset('storage/' . $facility->banner) }}" alt="{{ $facility->title }}" style="max-width: 300px; max-height: 200px; border-radius: 4px;">
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="order" class="form-label">Urutan *</label>
                        <input
                            type="number"
                            class="form-control @error('order') is-invalid @enderror"
                            id="order"
                            name="order"
                            value="{{ old('order', $facility->order ?? 0) }}"
                            min="0"
                            required
                        >
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Angka lebih kecil akan ditampilkan lebih dulu</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <div class="form-check pt-4">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="is_active"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $facility->is_active ?? true) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="is_active">
                                Aktif (Tampil di halaman)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    {{ isset($facility) ? 'Update Fasilitas' : 'Tambah Fasilitas' }}
                </button>
                <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

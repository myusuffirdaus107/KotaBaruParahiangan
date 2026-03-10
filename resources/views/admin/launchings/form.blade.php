@extends('admin.layouts.app')

@section('title', (isset($launching) ? 'Edit' : 'Tambah') . ' Launching - Admin')
@section('page-title', (isset($launching) ? 'Edit Launching Campaign' : 'Tambah Launching Campaign Baru'))

@section('content')
<a href="{{ route('admin.launchings.index') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card" style="border-radius: 8px; border: 1px solid #e2e8f0;">
    <div class="card-body">
        <form action="{{ isset($launching) ? route('admin.launchings.update', $launching) : route('admin.launchings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($launching))
                @method('PUT')
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 6px;">
                <strong><i class="fas fa-exclamation-circle"></i> Ada Kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Nama Launching <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title', $launching->title ?? '') }}"
                            placeholder="Contoh: Tatar Bungawari"
                            required
                            style="border-radius: 6px; border: 1px solid #e2e8f0;"
                        >
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('slug') is-invalid @enderror"
                            id="slug"
                            name="slug"
                            value="{{ old('slug', $launching->slug ?? '') }}"
                            placeholder="tatar-bungawari"
                            required
                            style="border-radius: 6px; border: 1px solid #e2e8f0;"
                        >
                        @error('slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">URL-friendly identifier (huruf kecil dan tanda hubung)</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="location" class="form-label">Lokasi</label>
                        <input
                            type="text"
                            class="form-control @error('location') is-invalid @enderror"
                            id="location"
                            name="location"
                            value="{{ old('location', $launching->location ?? '') }}"
                            placeholder="Jl. Sudirman, Kotabaru"
                            style="border-radius: 6px; border: 1px solid #e2e8f0;"
                        >
                        @error('location')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="developer" class="form-label">Developer</label>
                        <input
                            type="text"
                            class="form-control @error('developer') is-invalid @enderror"
                            id="developer"
                            name="developer"
                            value="{{ old('developer', $launching->developer ?? '') }}"
                            placeholder="PT Kotabaru Property"
                            style="border-radius: 6px; border: 1px solid #e2e8f0;"
                        >
                        @error('developer')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="launch_date" class="form-label">Tanggal Launching</label>
                        <input
                            type="date"
                            class="form-control @error('launch_date') is-invalid @enderror"
                            id="launch_date"
                            name="launch_date"
                            value="{{ old('launch_date', $launching->launch_date ?? '') }}"
                            style="border-radius: 6px; border: 1px solid #e2e8f0;"
                        >
                        @error('launch_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required style="border-radius: 6px; border: 1px solid #e2e8f0;">
                            <option value="">-- Pilih Status --</option>
                            <option value="coming_soon" {{ old('status', $launching->status ?? '') == 'coming_soon' ? 'selected' : '' }}>
                                Coming Soon
                            </option>
                            <option value="active" {{ old('status', $launching->status ?? '') == 'active' ? 'selected' : '' }}>
                                Aktif (Tampil di Frontend)
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">Status "Aktif" akan ditampilkan di halaman utama</small>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="image" class="form-label">Gambar Launching</label>
                <div class="input-group">
                    <input
                        type="file"
                        class="form-control @error('image') is-invalid @enderror"
                        id="image"
                        name="image"
                        accept="image/jpeg,image/png,image/jpg,image/gif"
                        style="border-radius: 6px 0 0 6px; border: 1px solid #e2e8f0;"
                    >
                    <label class="input-group-text" style="border-radius: 0 6px 6px 0; border: 1px solid #e2e8f0; background-color: #f8fafc;">Upload</label>
                </div>
                <small class="text-muted d-block mt-1">Format: JPEG, PNG, JPG, GIF | Ukuran maksimal: 10MB</small>

                @if(isset($launching) && $launching->image)
                <div class="mt-3">
                    <label class="form-label"><strong>Gambar Saat Ini</strong></label>
                    <div>
                        <img src="{{ Storage::url($launching->image) }}" alt="Launching Image"
                             style="max-width: 100%; max-height: 250px; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    </div>
                </div>
                @endif

                @error('image')
                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Tuliskan deskripsi lengkap tentang launching campaign..."
                    style="border-radius: 6px; border: 1px solid #e2e8f0;"
                >{{ old('description', $launching->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="text-muted d-block mt-1">Gunakan beberapa paragraf untuk menjelaskan launching ini</small>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                <button type="submit" class="btn btn-primary" style="min-width: 200px; border-radius: 6px;">
                    <i class="fas fa-save"></i>
                    {{ isset($launching) ? 'Perbarui Launching' : 'Tambah Launching' }}
                </button>
                <a href="{{ route('admin.launchings.index') }}" class="btn btn-secondary" style="border-radius: 6px;">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

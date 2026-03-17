@extends('admin.layouts.app')

@section('title', (isset($property) ? 'Edit' : 'Tambah') . ' Property - Admin')
@section('page-title', (isset($property) ? 'Edit Property' : 'Tambah Property Baru'))

@section('content')
<a href="{{ route('admin.properties.index') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($property) ? route('admin.properties.update', $property) : route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($property))
                @method('PUT')
            @endif

            {{-- Judul & Slug --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Judul Property *</label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title', $property->title ?? '') }}"
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input
                            type="text"
                            class="form-control @error('slug') is-invalid @enderror"
                            id="slug"
                            name="slug"
                            value="{{ old('slug', $property->slug ?? '') }}"
                            placeholder="Biarkan kosong untuk auto-generate dari judul"
                        >
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Auto-generate dari judul. Double-click untuk reset.
                        </small>
                    </div>
                </div>
            </div>

            {{-- Category & Lokasi --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="category_id" class="form-label">Category *</label>
                        <select
                            class="form-select @error('category_id') is-invalid @enderror"
                            id="category_id"
                            name="category_id"
                            required
                        >
                            <option value="">-- Pilih Category --</option>
                            @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $property->category_id ?? '') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="location" class="form-label">Lokasi *</label>
                        <input
                            type="text"
                            class="form-control @error('location') is-invalid @enderror"
                            id="location"
                            name="location"
                            value="{{ old('location', $property->location ?? '') }}"
                            required
                        >
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Harga --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="price_from" class="form-label">Harga Dari (Rp)</label>
                        <input
                            type="number"
                            class="form-control @error('price_from') is-invalid @enderror"
                            id="price_from"
                            name="price_from"
                            value="{{ old('price_from', $property->price_from ?? '') }}"
                        >
                        @error('price_from')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="price_to" class="form-label">Harga Hingga (Rp)</label>
                        <input
                            type="number"
                            class="form-control @error('price_to') is-invalid @enderror"
                            id="price_to"
                            name="price_to"
                            value="{{ old('price_to', $property->price_to ?? '') }}"
                        >
                        @error('price_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="form-group mb-3">
                <label for="short_description" class="form-label">Deskripsi Singkat</label>
                <textarea
                    class="form-control @error('short_description') is-invalid @enderror"
                    id="short_description"
                    name="short_description"
                    rows="2"
                >{{ old('short_description', $property->short_description ?? '') }}</textarea>
                @error('short_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi Lengkap --}}
            <div class="form-group mb-3">
                <label for="description" class="form-label">
                    Deskripsi Lengkap
                </label>
                <small class="d-block text-muted mb-1">
                    Baris kosong = paragraf baru. Awali baris dengan <code>-</code> atau <code>•</code> untuk bullet point.
                    Contoh: <code>- Lokasi strategis</code>
                </small>
                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                    rows="10"
                    placeholder="Contoh:&#10;Properti ini terletak di kawasan premium.&#10;&#10;Keunggulan:&#10;- Lokasi strategis&#10;- Desain modern&#10;- Akses mudah"
                >{{ old('description', $property->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status & Featured --}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="status" class="form-label">Status *</label>
            <select class="form-select @error('status') is-invalid @enderror"
                    id="status" name="status" required>
                <option value="available"
                    {{ old('status', $property->status ?? 'available') === 'available' ? 'selected' : '' }}>
                    Tersedia
                </option>
                <option value="sold_out"
                    {{ old('status', $property->status ?? '') === 'sold_out' ? 'selected' : '' }}>
                    Sold Out
                </option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <div class="form-check mt-4">
                <input type="checkbox" class="form-check-input"
                       id="featured" name="featured" value="1"
                       {{ old('featured', $property->featured ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="featured">
                    <strong>Featured Property</strong>
                    <small class="d-block text-muted">Ditampilkan di halaman utama (kusus kategori hunian)</small>
                </label>
            </div>
        </div>
    </div>
</div>

            {{-- Brochure --}}
            <div class="form-group mb-3" style="border-top: 1px solid #ddd; padding-top: 20px; margin-top: 10px;">
                <label class="form-label fw-bold">Brochure (PDF, Max 10MB)</label>

                @if(isset($property) && $property->brochure)
                    <div class="alert alert-info d-flex align-items-center justify-content-between mb-2">
                        <span>
                            <i class="fas fa-file-pdf text-danger"></i>
                            Brochure sudah diupload:
                            <a href="{{ asset('storage/' . $property->brochure) }}" target="_blank" class="ms-1">
                                Lihat PDF
                            </a>
                        </span>
                        <div class="form-check mb-0 ms-3">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="delete_brochure"
                                name="delete_brochure"
                                value="1"
                            >
                            <label class="form-check-label text-danger" for="delete_brochure">
                                Hapus Brochure
                            </label>
                        </div>
                    </div>
                @endif

                <input
                    type="file"
                    class="form-control @error('brochure') is-invalid @enderror"
                    id="brochure"
                    name="brochure"
                    accept=".pdf"
                >
                <small class="form-text text-muted">Upload file baru untuk mengganti brochure yang sudah ada</small>
                @error('brochure')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Upload Gambar Baru --}}
            <div class="form-group mb-3" style="border-top: 1px solid #ddd; padding-top: 20px; margin-top: 10px;">
                <label for="images" class="form-label fw-bold">Upload Gambar Property (JPEG, PNG, JPG, GIF - Max 5MB per gambar)</label>
                <input
                    type="file"
                    class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                    id="images"
                    name="images[]"
                    multiple
                    accept="image/jpeg,image/png,image/jpg,image/gif"
                >
                <small class="form-text text-muted">Anda dapat upload multiple gambar sekaligus</small>
                @error('images')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @error('images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Gambar yang Sudah Ada --}}
            @if(isset($property) && $property->images->count() > 0)
            <div class="form-group mb-3">
                <label class="form-label fw-bold">Gambar yang Sudah Diupload</label>
                <div class="row">
                    @foreach($property->images as $image)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ Storage::url($image->image_path) }}" class="card-img-top" alt="Property Image" style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        id="delete_image_{{ $image->id }}"
                                        name="delete_images[]"
                                        value="{{ $image->id }}"
                                    >
                                    <label class="form-check-label small text-danger" for="delete_image_{{ $image->id }}">
                                        Hapus
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Tombol Submit --}}
            <div style="display: flex; gap: 10px; margin-top: 30px; border-top: 1px solid #ddd; padding-top: 20px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    {{ isset($property) ? 'Update Property' : 'Tambah Property' }}
                </button>
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const titleInput = document.getElementById('title');
    const slugField  = document.getElementById('slug');

    titleInput.addEventListener('input', function () {
        // Jangan overwrite jika slug sudah diisi manual
        if (slugField.value.trim() !== '') return;

        slugField.value = this.value
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')  // hapus aksen
            .replace(/[^a-z0-9\s-]/g, '')     // hapus karakter spesial
            .trim()
            .replace(/\s+/g, '-')             // spasi → tanda hubung
            .replace(/-+/g, '-');             // hapus tanda hubung ganda
    });

    // Double-click slug untuk reset agar bisa di-generate ulang
    slugField.addEventListener('dblclick', function () {
        if (confirm('Reset slug? Slug akan di-generate ulang dari judul saat Anda mengetik.')) {
            this.value = '';
            titleInput.dispatchEvent(new Event('input'));
        }
    });
</script>
@endsection
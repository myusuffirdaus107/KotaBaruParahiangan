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
                        <label for="slug" class="form-label">Slug *</label>
                        <input 
                            type="text" 
                            class="form-control @error('slug') is-invalid @enderror" 
                            id="slug" 
                            name="slug" 
                            value="{{ old('slug', $property->slug ?? '') }}"
                            required
                        >
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
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
            
            <div class="form-group mb-3">
                <label for="description" class="form-label">Deskripsi Lengkap</label>
                <textarea 
                    class="form-control @error('description') is-invalid @enderror" 
                    id="description" 
                    name="description" 
                    rows="6"
                >{{ old('description', $property->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="is_featured" 
                                name="is_featured" 
                                value="1"
                                {{ old('is_featured', $property->is_featured ?? false) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="is_featured">
                                Featured Property
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="is_available" 
                                name="is_available" 
                                value="1"
                                {{ old('is_available', $property->is_available ?? true) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="is_available">
                                Tersedia
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="brochure" class="form-label">Upload Brochure (PDF, Max 10MB)</label>
                <input 
                    type="file" 
                    class="form-control @error('brochure') is-invalid @enderror" 
                    id="brochure" 
                    name="brochure"
                    accept=".pdf"
                >
                @error('brochure')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gallery Images Upload -->
            <div class="form-group mb-3" style="border-top: 1px solid #ddd; padding-top: 20px; margin-top: 20px;">
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

            <!-- Existing Images -->
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
                                    <label class="form-check-label small" for="delete_image_{{ $image->id }}">
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
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
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

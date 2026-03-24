@extends('admin.layouts.app')

@section('title', (isset($slider) ? 'Edit' : 'Tambah') . ' Slider - Admin')
@section('page-title', (isset($slider) ? 'Edit Slider' : 'Tambah Slider Baru'))

@section('content')
<a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary bg-white mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($slider) ? route('admin.sliders.update', $slider) : route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($slider))
                @method('PUT')
            @endif
            
            <div class="form-group mb-3">
                <label for="title" class="form-label">Judul *</label>
                <input 
                    type="text" 
                    class="form-control @error('title') is-invalid @enderror" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $slider->title ?? '') }}"
                    required
                >
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input 
                    type="text" 
                    class="form-control @error('subtitle') is-invalid @enderror" 
                    id="subtitle" 
                    name="subtitle" 
                    value="{{ old('subtitle', $slider->subtitle ?? '') }}"
                >
                @error('subtitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="image" class="form-label">Upload Gambar (JPEG, PNG, JPG, GIF - Max 5MB)</label>
                <input 
                    type="file" 
                    class="form-control @error('image') is-invalid @enderror" 
                    id="image" 
                    name="image"
                    accept="image/jpeg,image/png,image/jpg,image/gif"
                >
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                @if(isset($slider) && $slider->image)
                <div class="mt-3">
                    <label class="form-label">Gambar Saat Ini</label>
                    <div>
                        <img src="{{ Storage::url($slider->image) }}" alt="Slider Image" style="max-width: 100%; max-height: 300px; border-radius: 4px;">
                    </div>
                </div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="order" class="form-label">Urutan</label>
                <input 
                    type="number" 
                    class="form-control @error('order') is-invalid @enderror" 
                    id="order" 
                    name="order" 
                    value="{{ old('order', $slider->order ?? 0) }}"
                    min="0"
                >
                @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <div class="form-check">
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        id="is_active" 
                        name="is_active" 
                        value="1"
                        {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="is_active">
                        Aktif / Tampilkan
                    </label>
                </div>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> 
                    {{ isset($slider) ? 'Update Slider' : 'Tambah Slider' }}
                </button>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

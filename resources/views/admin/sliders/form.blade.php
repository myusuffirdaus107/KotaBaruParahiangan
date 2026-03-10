@extends('admin.layouts.app')

@section('title', (isset($slider) ? 'Edit' : 'Tambah') . ' Slider - Admin')
@section('page-title', (isset($slider) ? 'Edit Slider' : 'Tambah Slider Baru'))

@section('content')
<a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary mb-3">
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
                <label for="description" class="form-label">Deskripsi</label>
                <textarea 
                    class="form-control @error('description') is-invalid @enderror" 
                    id="description" 
                    name="description" 
                    rows="4"
                >{{ old('description', $slider->description ?? '') }}</textarea>
                @error('description')
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
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="button_text" class="form-label">Teks Tombol</label>
                        <input 
                            type="text" 
                            class="form-control @error('button_text') is-invalid @enderror" 
                            id="button_text" 
                            name="button_text" 
                            value="{{ old('button_text', $slider->button_text ?? '') }}"
                        >
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="button_link" class="form-label">Link Tombol</label>
                        <input 
                            type="text" 
                            class="form-control @error('button_link') is-invalid @enderror" 
                            id="button_link" 
                            name="button_link" 
                            value="{{ old('button_link', $slider->button_link ?? '') }}"
                        >
                        @error('button_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
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

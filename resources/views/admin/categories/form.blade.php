@extends('admin.layouts.app')

@section('title', (isset($category) ? 'Edit' : 'Tambah') . ' Category - Admin')
@section('page-title', (isset($category) ? 'Edit Category' : 'Tambah Category Baru'))

@section('content')
<a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama Category *</label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $category->name ?? '') }}"
                            required
                        >
                        @error('name')
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
                            value="{{ old('slug', $category->slug ?? '') }}"
                            required
                        >
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> 
                    {{ isset($category) ? 'Update Category' : 'Tambah Category' }}
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

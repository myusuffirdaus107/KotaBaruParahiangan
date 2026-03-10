@extends('admin.layouts.app')

@section('title', 'Tentang Kami & Visi Misi - Admin')
@section('page-title', 'Tentang Kami & Visi Misi')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.about.edit') }}" class="btn btn-primary">
        <i class="fas fa-edit"></i> Edit Content
    </a>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Tentang Kami</h5>
    </div>
    <div class="card-body">
        <h3>{{ $about->section_title }}</h3>
        @if($about->image_path)
            <img src="{{ Storage::url($about->image_path) }}" alt="About Image" style="width: 100%; max-width: 500px; height: auto; border-radius: 8px; margin: 20px 0;">
        @endif
        <p>{{ $about->description }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4" style="border-left: 4px solid #10b981;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-star"></i> VISI</h5>
            </div>
            <div class="card-body">
                <h6 style="color: #10b981; font-weight: 600; margin-bottom: 10px;">{{ $about->vision_title }}</h6>
                <p>{{ $about->vision_content }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-4" style="border-left: 4px solid #0ea5e9;">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-bullseye"></i> MISI</h5>
            </div>
            <div class="card-body">
                <p>{{ $about->mission_content }}</p>
            </div>
        </div>
    </div>
</div>

@if($about->vision_mission_image)
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-image"></i> Gambar Visi & Misi</h5>
    </div>
    <div class="card-body">
        <img src="{{ Storage::url($about->vision_mission_image) }}" alt="Vision Mission Image" style="width: 100%; max-width: 600px; height: auto; border-radius: 8px;">
    </div>
</div>
@endif

@endsection

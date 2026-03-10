@extends('admin.layouts.app')

@section('title', 'Edit Tentang Kami & Visi Misi - Admin')
@section('page-title', 'Edit Tentang Kami & Visi Misi')

@section('content')

<a href="{{ route('admin.about.show') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- TENTANG KAMI SECTION --}}
            <div class="alert alert-info mb-4">
                <strong><i class="fas fa-info-circle"></i> Bagian Tentang Kami</strong>
            </div>

            {{-- Section Title --}}
            <div class="form-group mb-3">
                <label for="section_title" class="form-label">Judul Section *</label>
                <input
                    type="text"
                    class="form-control @error('section_title') is-invalid @enderror"
                    id="section_title"
                    name="section_title"
                    value="{{ old('section_title', $about->section_title) }}"
                    required
                >
                @error('section_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="form-group mb-3">
                <label for="description" class="form-label">Deskripsi *</label>
                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                    rows="5"
                    required
                >{{ old('description', $about->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            <div class="form-group mb-3">
                <label for="image" class="form-label">Gambar Tentang Kami</label>
                <input
                    type="file"
                    class="form-control @error('image') is-invalid @enderror"
                    id="image"
                    name="image"
                    accept="image/*"
                >
                @if($about->image_path)
                    <div style="margin-top: 10px;">
                        <img src="{{ Storage::url($about->image_path) }}" alt="Current Image" style="width: 150px; height: auto; border-radius: 8px;">
                        <p style="font-size: 0.85rem; color: #6b7280; margin-top: 5px;">Gambar saat ini</p>
                    </div>
                @endif
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr style="margin: 30px 0;">

            {{-- VISI & MISI SECTION --}}
            <div class="alert alert-success mb-4">
                <strong><i class="fas fa-lightbulb"></i> Bagian Visi & Misi</strong>
            </div>

            {{-- Vision Title --}}
            <div class="form-group mb-3">
                <label for="vision_title" class="form-label"><strong>⭐ Judul Visi</strong> *</label>
                <input
                    type="text"
                    class="form-control @error('vision_title') is-invalid @enderror"
                    id="vision_title"
                    name="vision_title"
                    value="{{ old('vision_title', $visionMission->vision_title) }}"
                    placeholder="Contoh: Visi, Visi Kami, dll"
                    required
                >
                @error('vision_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Vision Content --}}
            <div class="form-group mb-3">
                <label for="vision_content" class="form-label"><strong>📝 Isi Visi</strong> *</label>
                <textarea
                    class="form-control @error('vision_content') is-invalid @enderror"
                    id="vision_content"
                    name="vision_content"
                    rows="4"
                    required
                >{{ old('vision_content', $about->vision_content) }}</textarea>
                @error('vision_content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Mission Content --}}
            <div class="form-group mb-3">
                <label for="mission_content" class="form-label"><strong>📝 Isi Misi</strong> *</label>
                <textarea
                    class="form-control @error('mission_content') is-invalid @enderror"
                    id="mission_content"
                    name="mission_content"
                    rows="4"
                    required
                >{{ old('mission_content', $about->mission_content) }}</textarea>
                @error('mission_content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Vision Mission Image --}}
            <div class="form-group mb-3">
                <label for="vision_mission_image" class="form-label"><strong>🖼️ Gambar Visi & Misi</strong></label>
                <div style="background-color: #f0f9ff; border: 2px dashed #0ea5e9; padding: 15px; border-radius: 8px; margin: 10px 0;">
                    <p style="color: #0369a1; font-size: 0.9rem; margin: 0;"><i class="fas fa-info-circle"></i> Ukuran maksimal: 2MB | Format: JPG, PNG, GIF</p>
                </div>
                <input
                    type="file"
                    class="form-control @error('vision_mission_image') is-invalid @enderror"
                    id="vision_mission_image"
                    name="vision_mission_image"
                    accept=".jpg,.jpeg,.png,.gif"
                    onchange="handleImageSelect(event)"
                >
                <small style="color: #6b7280; display: block; margin-top: 5px;">Upload gambar untuk Visi & Misi (opsional)</small>

                @if($about->vision_mission_image)
                    <div style="margin-top: 15px;">
                        <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 8px;"><strong>📸 Gambar saat ini:</strong></p>
                        <img src="{{ Storage::url($about->vision_mission_image) }}" alt="Current Vision Image" style="max-width: 100%; height: 250px; border-radius: 8px; border: 2px solid #e5e7eb; object-fit: cover;">
                    </div>
                @endif

                <div id="previewContainer" style="margin-top: 15px; display: none;">
                    <p style="color: #10b981; font-size: 0.9rem; margin-bottom: 8px;"><strong>✨ Preview gambar baru:</strong></p>
                    <img id="previewImage" style="max-width: 100%; height: 250px; border-radius: 8px; border: 3px solid #10b981; object-fit: cover;">
                    <p id="fileName" style="color: #6b7280; font-size: 0.85rem; margin-top: 8px;"></p>
                </div>

                @error('vision_mission_image')
                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function handleImageSelect(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const fileName = document.getElementById('fileName');

    if (file) {
        // Check file size
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal 2MB.');
            event.target.value = '';
            previewContainer.style.display = 'none';
            return;
        }

        // Check file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung! Hanya JPG, PNG, atau GIF yang diperbolehkan.');
            event.target.value = '';
            previewContainer.style.display = 'none';
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            fileName.textContent = '📄 ' + file.name + ' (' + (file.size / 1024).toFixed(2) + 'KB)';
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection

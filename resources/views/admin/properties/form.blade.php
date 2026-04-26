@extends('admin.layouts.app')

@section('title', (isset($property) ? 'Edit' : 'Tambah') . ' Property - Admin')
@section('page-title', (isset($property) ? 'Edit Property' : 'Tambah Property Baru'))

@section('content')
<a href="{{ route('admin.properties.index') }}" class="btn btn-secondary bg-white mb-3">
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

            {{-- Deskripsi Lengkap --}}
            <div class="form-group mb-3">
                <label for="description" class="form-label">
                    Deskripsi Lengkap
                </label>

                {{-- Hidden input yang dikirim ke server --}}
                <input type="hidden" name="description" id="description-input">

                {{-- Quill Editor Container --}}
                <div id="quill-editor" style="height: 300px; border-radius: 0 0 4px 4px;"></div>

                @error('description')
                    <div class="text-danger small mt-1">{{ $message }}</div>
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
// Muat Quill secara dinamis, baru inisialisasi setelah benar-benar siap
(function() {
    // Load CSS
    const link = document.createElement('link');
    link.rel  = 'stylesheet';
    link.href = 'https://cdn.quilljs.com/1.3.7/quill.snow.css';
    document.head.appendChild(link);

    // Load JS
    const script = document.createElement('script');
    script.src = 'https://cdn.quilljs.com/1.3.7/quill.min.js';
    script.onload = function () { initQuill(); };
    document.head.appendChild(script);
})();

function initQuill() {
    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Tulis deskripsi properti di sini...',
        modules: {
            toolbar: [
                [{ header: [2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link'],
                ['clean'],
            ],
        },
    });

    const hiddenInput = document.getElementById('description-input');

    // ── Isi nilai awal ke editor ──────────────────────────────────────────
    const oldValue = {!! json_encode(old('description', $property->description ?? '')) !!};

    if (oldValue && oldValue.trim() !== '') {
        const isHtml = /<[a-z][\s\S]*>/i.test(oldValue);
        if (isHtml) {
            quill.clipboard.dangerouslyPasteHTML(oldValue);
        } else {
            const asHtml = oldValue
                .split(/\n\n+/)
                .map(para => `<p>${para.replace(/\n/g, '<br>')}</p>`)
                .join('');
            quill.clipboard.dangerouslyPasteHTML(asHtml);
        }
        // ✅ Langsung sync ke hidden input setelah set nilai awal
        hiddenInput.value = quill.root.innerHTML;
    }

    // ✅ Sync realtime setiap kali konten Quill berubah
    // Ini solusi utama — tidak bergantung pada event submit sama sekali
    quill.on('text-change', function () {
        const html = quill.root.innerHTML;
        hiddenInput.value = (html === '<p><br></p>' || html.trim() === '') ? '' : html;
    });

    // ✅ Guard tambahan saat submit — double safety
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        const html = quill.root.innerHTML;
        hiddenInput.value = (html === '<p><br></p>' || html.trim() === '') ? '' : html;
    }, true); // true = capture phase, lebih awal dari bubble

    // ── Slug Auto-generate ────────────────────────────────────────────────
    const titleInput = document.getElementById('title');
    const slugField  = document.getElementById('slug');

    titleInput.addEventListener('input', function () {
        if (slugField.value.trim() !== '') return;
        slugField.value = this.value
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    });

    slugField.addEventListener('dblclick', function () {
        if (confirm('Reset slug? Slug akan di-generate ulang dari judul saat Anda mengetik.')) {
            this.value = '';
            titleInput.dispatchEvent(new Event('input'));
        }
    });
}
</script>
@endsection
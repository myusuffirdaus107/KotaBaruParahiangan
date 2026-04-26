@extends('admin.layouts.app')

@section('title', 'Edit Hunian Unggulan - Admin')
@section('page-title', 'Edit Hunian Unggulan')

@section('content')

<a href="{{ route('admin.hunian-unggulan.show') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.hunian-unggulan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ── INFORMASI PROPERTI ── --}}
            <div class="alert alert-info mb-4">
                <strong><i class="fas fa-home"></i> Informasi Properti</strong>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Nama Properti *</label>
                        <input type="text" name="property_name"
                               class="form-control @error('property_name') is-invalid @enderror"
                               value="{{ old('property_name', $hunian->property_name) }}"
                               placeholder="Contoh: KOTA BARU PARAHYANGAN" required>
                        @error('property_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Nama Tatar / Klaster</label>
                        <input type="text" name="tatar_name"
                               class="form-control @error('tatar_name') is-invalid @enderror"
                               value="{{ old('tatar_name', $hunian->tatar_name) }}"
                               placeholder="Contoh: Tatar Bungawari">
                        @error('tatar_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group mb-3">
                        <label class="form-label">Lokasi / Alamat</label>
                        <input type="text" name="location"
                               class="form-control @error('location') is-invalid @enderror"
                               value="{{ old('location', $hunian->location) }}"
                               placeholder="Contoh: Jl. Ahmad Yani, Kotabaru">
                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label class="form-label">Label Badge</label>
                        <input type="text" name="badge_label"
                               class="form-control @error('badge_label') is-invalid @enderror"
                               value="{{ old('badge_label', $hunian->badge_label) }}"
                               placeholder="New Launching">
                        @error('badge_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Foto --}}
            <div class="form-group mb-3">
                <label class="form-label">Foto Properti</label>
                @if($hunian->image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $hunian->image) }}"
                             alt="Foto saat ini"
                             style="width:200px;height:130px;object-fit:cover;border-radius:8px;border:1px solid var(--border);">
                        <p style="font-size:.82rem;color:var(--muted);margin-top:5px;">Foto saat ini</p>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" name="delete_image" value="1" id="deleteImage">
                        <label class="form-check-label text-danger" for="deleteImage" style="font-size:.82rem;">
                            Hapus foto ini
                        </label>
                    </div>
                @endif
                <input type="file" name="image" id="imageInput"
                       class="form-control @error('image') is-invalid @enderror"
                       accept="image/jpeg,image/png,image/jpg,image/webp">
                <small class="text-muted">JPEG, PNG, WebP – maks. 5MB</small>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror

                <div id="previewContainer" style="display:none;margin-top:10px;">
                    <img id="previewImage" src="#" alt="Preview"
                         style="width:200px;height:130px;object-fit:cover;border-radius:8px;border:2px solid #10b981;">
                    <p style="font-size:.82rem;color:#10b981;margin-top:4px;">✨ Preview foto baru</p>
                </div>
            </div>

            <hr style="margin: 24px 0;">

            {{-- ── HARGA CICILAN ── --}}
            <div class="alert alert-success mb-4">
                <strong><i class="fas fa-tag"></i> Harga Cicilan</strong>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label class="form-label">Harga (dalam Juta)</label>
                        <div class="input-group">
                            <input type="number" step="0.1" min="0" name="cicilan_harga"
                                   class="form-control @error('cicilan_harga') is-invalid @enderror"
                                   value="{{ old('cicilan_harga', $hunian->cicilan_harga) }}"
                                   placeholder="16">
                            <span class="input-group-text" style="background:var(--bg);border-color:var(--border);font-size:.82rem;">Juta</span>
                        </div>
                        <small class="text-muted">Isi dalam satuan Juta. Contoh: 16 artinya 16 Juta</small>
                        @error('cicilan_harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="cicilan_unit"
                               class="form-control"
                               value="{{ old('cicilan_unit', $hunian->cicilan_unit) }}"
                               placeholder="Juta / bulan">
                        <small class="text-muted">Contoh: "Juta / bulan"</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label class="form-label">Catatan Harga</label>
                        <input type="text" name="price_note"
                               class="form-control"
                               value="{{ old('price_note', $hunian->price_note) }}"
                               placeholder="*Harga dapat berubah sewaktu-waktu">
                    </div>
                </div>
            </div>

            <hr style="margin: 24px 0;">

            {{-- ── BONUS & KEUNTUNGAN ── --}}
            <div class="alert" style="background:#fef9ec;border-left:4px solid var(--gold,#c9a84c);color:#92620a;">
                <strong><i class="fas fa-gift"></i> Bonus &amp; Keuntungan</strong>
                <small class="d-block mt-1" style="font-weight:400;">
                    Isi 1–4 bonus. Baris yang labelnya kosong tidak akan disimpan. Tampilan di website menyesuaikan jumlah bonus secara otomatis.
                </small>
            </div>

            @php
                $existingBenefits = [];
                if(old('benefit_title')) {
                    foreach(old('benefit_title', []) as $i => $t) {
                        $existingBenefits[] = ['title' => $t, 'value' => old('benefit_value.'.$i, '')];
                    }
                } else {
                    $existingBenefits = $hunian->benefits_list;
                }
                // Pastikan selalu ada 4 baris di form
                while(count($existingBenefits) < 4) {
                    $existingBenefits[] = ['title' => '', 'value' => ''];
                }
            @endphp

            @foreach($existingBenefits as $idx => $benefit)
            <div class="row align-items-center mb-2">
                <div class="col-auto" style="width:36px;color:var(--muted);font-weight:700;font-size:.82rem;padding-top:6px;">
                    {{ $idx + 1 }}
                </div>
                <div class="col-md-3">
                    <input type="text" name="benefit_title[]"
                           class="form-control form-control-sm"
                           value="{{ $benefit['title'] ?? '' }}"
                           placeholder="Label (FREE)">
                </div>
                <div class="col">
                    <input type="text" name="benefit_value[]"
                           class="form-control form-control-sm"
                           value="{{ $benefit['value'] ?? '' }}"
                           placeholder="Nama bonus (Sport Club 1 Tahun)">
                </div>
            </div>
            @endforeach

            <small class="text-muted d-block mb-4">
                <i class="fas fa-info-circle me-1"></i>
                Baris yang kolom Label-nya kosong akan diabaikan.
            </small>

            {{-- ── SUBMIT ── --}}
            <div style="border-top:1px solid var(--border);padding-top:20px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.hunian-unggulan.show') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.getElementById('imageInput')?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('previewImage').src = e.target.result;
        document.getElementById('previewContainer').style.display = 'block';
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
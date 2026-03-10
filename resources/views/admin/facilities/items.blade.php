@extends('admin.layouts.app')

@section('title', 'Kelola Items - ' . $facility->title)
@section('page-title', 'Kelola Items Fasilitas: ' . $facility->title)

@section('content')
<a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-plus"></i> Tambah Item Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.facilities.items.store', $facility) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama Item *</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Deskripsi *</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="3"
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="image" class="form-label">Gambar/Foto</label>
                        <input
                            type="file"
                            class="form-control @error('image') is-invalid @enderror"
                            id="image"
                            name="image"
                            accept="image/*"
                        >
                        <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="order" class="form-label">Urutan *</label>
                        <input
                            type="number"
                            class="form-control @error('order') is-invalid @enderror"
                            id="order"
                            name="order"
                            value="{{ old('order', 0) }}"
                            min="0"
                            required
                        >
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-plus"></i> Tambah Item
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Items</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">Foto</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($facility->facilityItems as $item)
                            <tr>
                                <td>
                                    @if($item->image)
                                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <div style="width: 50px; height: 50px; background: #e5e7eb; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image" style="color: #9ca3af; font-size: 1.2rem;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $item->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.facilities.items.destroy', [$facility, $item]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus item ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Item: {{ $item->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.facilities.items.update', [$facility, $item]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="edit_name_{{ $item->id }}" class="form-label">Nama Item *</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="edit_name_{{ $item->id }}"
                                                        name="name"
                                                        value="{{ $item->name }}"
                                                        required
                                                    >
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="edit_description_{{ $item->id }}" class="form-label">Deskripsi *</label>
                                                    <textarea
                                                        class="form-control"
                                                        id="edit_description_{{ $item->id }}"
                                                        name="description"
                                                        rows="3"
                                                        required
                                                    >{{ $item->description }}</textarea>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="edit_image_{{ $item->id }}" class="form-label">Gambar/Foto</label>
                                                    <input
                                                        type="file"
                                                        class="form-control"
                                                        id="edit_image_{{ $item->id }}"
                                                        name="image"
                                                        accept="image/*"
                                                    >
                                                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah</small>
                                                    @if($item->image)
                                                        <div style="margin-top: 10px;">
                                                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;">
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="edit_order_{{ $item->id }}" class="form-label">Urutan *</label>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        id="edit_order_{{ $item->id }}"
                                                        name="order"
                                                        value="{{ $item->order }}"
                                                        min="0"
                                                        required
                                                    >
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Simpan Perubahan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox"></i> Belum ada item
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

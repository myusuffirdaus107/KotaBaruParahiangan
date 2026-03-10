@extends('admin.layouts.app')

@section('title', 'Categories - Admin')
@section('page-title', 'Kelola Categories')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Category Baru
    </a>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Slug</th>
                <th>Icon</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td><strong>{{ $category->name }}</strong></td>
                <td>{{ $category->slug }}</td>
                <td>
                    @if($category->icon)
                        <i class="{{ $category->icon }}"></i> {{ $category->icon }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ substr($category->description ?? '-', 0, 50) }}...</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Tidak ada categories</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $categories->links() }}
@endsection

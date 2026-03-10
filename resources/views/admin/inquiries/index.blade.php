@extends('admin.layouts.app')

@section('title', 'Inquiries - Admin')
@section('page-title', 'Kelola Inquiries')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                    <tr>
                        <td>{{ $inquiry->created_at->format('d M Y') }}</td>
                        <td><strong>{{ $inquiry->name }}</strong></td>
                        <td>{{ $inquiry->email }}</td>
                        <td>{{ $inquiry->phone }}</td>
                        <td>{{ substr($inquiry->message, 0, 30) }}...</td>
                        <td>
                            @if($inquiry->is_contacted)
                                <span class="badge bg-success"><i class="fas fa-check"></i> Terhubung</span>
                            @else
                                <span class="badge bg-warning"><i class="fas fa-clock"></i> Belum</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(!$inquiry->is_contacted)
                            <form action="{{ route('admin.inquiries.mark-contacted', $inquiry) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success" title="Tandai Terhubung">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Tidak ada inquiries</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div style="margin-top: 20px;">
            {{ $inquiries->links() }}
        </div>
    </div>
</div>
@endsection

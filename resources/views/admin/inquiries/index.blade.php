@extends('admin.layouts.app')
@section('title', 'Inquiries - Admin')
@section('page-title', 'Kelola Inquiries')

@section('content')
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table w-100 mb-0">
                <thead>
                    <tr>
                        <th class="col-2">Tanggal</th>
                        <th class="col-2">Nama</th>
                        <th class="col-3">Kontak</th>
                        <th class="col-3">Pesan</th>
                        <th class="col-1">Status</th>
                        <th class="col-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                    <tr>
                        <td>
                            <div style="font-size:.82rem;font-weight:600;color:var(--navy);">{{ $inquiry->created_at->format('d M Y') }}</div>
                            <div style="font-size:.72rem;color:var(--muted);">{{ $inquiry->created_at->diffForHumans() }}</div>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:9px;">
                                <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--blue2),var(--blue));display:grid;place-items:center;font-size:.75rem;font-weight:800;color:#fff;flex-shrink:0;">
                                    {{ strtoupper(substr($inquiry->name,0,1)) }}
                                </div>
                                <span style="font-weight:600;font-size:.84rem;">{{ $inquiry->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:.8rem;color:var(--text);">{{ $inquiry->email }}</div>
                            <div style="font-size:.78rem;color:var(--muted);">{{ $inquiry->phone }}</div>
                        </td>
                        <td style="font-size:.82rem;color:var(--muted);">
                            {{ Str::limit($inquiry->message, 50) }}
                        </td>
                        <td>
                            @if($inquiry->is_contacted)
                                <span style="background:#dcfce7;color:#15803d;font-size:.68rem;font-weight:700;padding:4px 10px;border-radius:100px;white-space:nowrap;">
                                    <i class="fas fa-check-circle me-1"></i> Sudah
                                </span>
                            @else
                                <span style="background:#fef9c3;color:#a16207;font-size:.68rem;font-weight:700;padding:4px 10px;border-radius:100px;white-space:nowrap;">
                                    <i class="fas fa-clock me-1"></i> Belum
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-primary" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$inquiry->is_contacted)
                                <form action="{{ route('admin.inquiries.mark-contacted', $inquiry) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-info" title="Tandai Dihubungi"><i class="fas fa-check"></i></button>
                                </form>
                                @endif
                                <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                            Tidak ada inquiries
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($inquiries->hasPages())
    <div class="card-body border-top pt-3">
        {{ $inquiries->links() }}
    </div>
    @endif
</div>
@endsection
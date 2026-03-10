@extends('admin.layouts.app')

@section('title', 'Detail Inquiry - Admin')
@section('page-title', 'Detail Inquiry')

@section('content')
<a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Informasi Inquiry</h5>
                
                <div style="display: grid; grid-template-columns: 200px 1fr; gap: 20px; margin-bottom: 30px;">
                    <div>
                        <label style="color: #9ca3af; font-size: 0.9rem;">Nama</label>
                        <p style="font-weight: 600; margin: 5px 0 0;">{{ $inquiry->name }}</p>
                    </div>
                    <div>
                        <label style="color: #9ca3af; font-size: 0.9rem;">Email</label>
                        <p style="margin: 5px 0 0;"><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></p>
                    </div>
                    <div>
                        <label style="color: #9ca3af; font-size: 0.9rem;">Telepon</label>
                        <p style="margin: 5px 0 0;"><a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a></p>
                    </div>
                    <div>
                        <label style="color: #9ca3af; font-size: 0.9rem;">Tanggal</label>
                        <p style="font-weight: 600; margin: 5px 0 0;">{{ $inquiry->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                
                <hr>
                
                <h5 class="mb-3" style="margin-top: 30px;">Pesan</h5>
                <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px; border-left: 4px solid #3b82f6;">
                    {{ $inquiry->message }}
                </div>
                
                @if($inquiry->property)
                <hr style="margin-top: 30px;">
                
                <h5 class="mb-3" style="margin-top: 30px;">Property Terkait</h5>
                <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px;">
                    <strong>{{ $inquiry->property->title }}</strong><br>
                    <small style="color: #9ca3af;">{{ $inquiry->property->location }}</small>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="mb-3">Status</h5>
                @if($inquiry->is_contacted)
                    <span class="badge bg-success" style="font-size: 1rem; padding: 10px 15px;">
                        <i class="fas fa-check-circle"></i> Sudah Terhubung
                    </span>
                @else
                    <span class="badge bg-warning" style="font-size: 1rem; padding: 10px 15px;">
                        <i class="fas fa-clock"></i> Belum Dikontak
                    </span>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Aksi</h5>
                @if(!$inquiry->is_contacted)
                <form action="{{ route('admin.inquiries.mark-contacted', $inquiry) }}" method="POST" class="mb-2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-check"></i> Tandai Sudah Dihubungi
                    </button>
                </form>
                @endif
                
                <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Yakin menghapus?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

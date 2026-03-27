@extends('admin.layouts.app')
@section('title', 'Detail Inquiry')
@section('page-title', 'Detail Inquiry')

@section('content')
<a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary mb-4">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="row g-3" style="align-items:start;">
    <div class="col-md-8">

        {{-- Profil --}}
        <div style="background:linear-gradient(135deg,var(--navy),#1a3a5c);border-radius:var(--radius);padding:22px 24px;display:flex;align-items:center;gap:16px;margin-bottom:12px;">
            <div style="width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,var(--blue2),var(--blue));display:grid;place-items:center;font-size:1.3rem;font-weight:800;color:#fff;flex-shrink:0;">
                {{ strtoupper(substr($inquiry->name,0,1)) }}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:1rem;font-weight:700;color:#fff;">{{ $inquiry->name }}</div>
                <div style="font-size:0.72rem;color:rgba(255,255,255,0.45);margin-top:2px;">
                    <i class="fas fa-clock me-1"></i>{{ $inquiry->created_at->format('d M Y, H:i') }} · {{ $inquiry->created_at->diffForHumans() }}
                </div>
            </div>
            @if($inquiry->is_contacted)
                <span style="background:#dcfce7;color:#15803d;font-size:.72rem;font-weight:700;padding:6px 14px;border-radius:100px;white-space:nowrap;flex-shrink:0;">
                    <i class="fas fa-check-circle me-1"></i> Sudah Dikontak
                </span>
            @else
                <span style="background:#fef9c3;color:#a16207;font-size:.72rem;font-weight:700;padding:6px 14px;border-radius:100px;white-space:nowrap;flex-shrink:0;">
                    <i class="fas fa-clock me-1"></i> Belum Dikontak
                </span>
            @endif
        </div>

        {{-- Info kontak --}}
        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center gap-2 py-3">
                        <div class="card-header-icon" style="background:rgba(139,92,246,0.1);color:var(--purple);flex-shrink:0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div style="min-width:0;">
                            <div style="font-size:.62rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.08em;">Email</div>
                            <div style="font-size:.82rem;font-weight:600;color:var(--navy);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $inquiry->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center gap-2 py-3">
                        <div class="card-header-icon" style="background:rgba(16,185,129,0.1);color:var(--success);flex-shrink:0;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <div style="font-size:.62rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.08em;">Telepon</div>
                            <div style="font-size:.82rem;font-weight:600;color:var(--navy);">{{ $inquiry->phone }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pesan --}}
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-comment-dots"></i></div> Pesan
            </div>
            <div class="card-body">
                <p style="font-size:.9rem;line-height:1.8;color:var(--text);border-left:3px solid var(--blue2);padding-left:14px;margin:0;white-space:pre-wrap;word-break:break-word;">{{ $inquiry->message }}</p>
            </div>
        </div>

        {{-- Properti terkait --}}
        @if($inquiry->property)
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-home"></i></div> Properti Terkait
            </div>
            <div class="card-body d-flex align-items-center gap-3">
                <div class="card-header-icon" style="width:40px;height:40px;background:rgba(37,150,190,0.1);color:var(--blue2);flex-shrink:0;">
                    <i class="fas fa-building"></i>
                </div>
                <div>
                    <div style="font-weight:700;font-size:.88rem;">{{ $inquiry->property->title }}</div>
                    <div style="font-size:.75rem;color:var(--muted);"><i class="fas fa-map-marker-alt me-1"></i>{{ $inquiry->property->location }}</div>
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- Sidebar --}}
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header"><div class="card-header-icon"><i class="fas fa-paper-plane"></i></div> Hubungi Via</div>
            <div class="card-body d-flex flex-column gap-2">
                @php
                    $wa = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $inquiry->phone));
                    $waMsg = urlencode('Halo ' . $inquiry->name . ', kami dari tim Kotabaru Parahyangan ingin menindaklanjuti inquiry Anda.');
                @endphp
                <a href="https://wa.me/{{ $wa }}?text={{ $waMsg }}" target="_blank"
                   class="btn w-100" style="background:#22c55e;color:#fff;font-weight:600;">
                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                </a>
                <a href="mailto:{{ $inquiry->email }}" class="btn btn-secondary w-100">
                    <i class="fas fa-envelope me-1"></i> Kirim Email
                </a>
                <a href="tel:{{ $inquiry->phone }}" class="btn btn-secondary w-100">
                    <i class="fas fa-phone me-1"></i> Telepon
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><div class="card-header-icon"><i class="fas fa-cog"></i></div> Aksi</div>
            <div class="card-body d-flex flex-column gap-2">
                @if(!$inquiry->is_contacted)
                <form action="{{ route('admin.inquiries.mark-contacted', $inquiry) }}" method="POST">
                    @csrf @method('PATCH')
                    <button class="btn btn-success w-100"><i class="fas fa-check me-1"></i> Tandai Sudah Dihubungi</button>
                </form>
                @else
                <div style="padding:10px 14px;background:#dcfce7;border:1px solid #bbf7d0;border-radius:9px;font-size:.82rem;font-weight:600;color:#15803d;">
                    <i class="fas fa-check-circle me-1"></i> Sudah ditandai dikontak
                </div>
                @endif
                <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger w-100" onclick="return confirm('Yakin menghapus?')">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
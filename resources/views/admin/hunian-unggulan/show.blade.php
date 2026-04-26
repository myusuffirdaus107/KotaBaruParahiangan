@extends('admin.layouts.app')

@section('title', 'Hunian Unggulan - Admin')
@section('page-title', 'Hunian Unggulan')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.hunian-unggulan.edit') }}" class="btn btn-primary">
        <i class="fas fa-edit"></i> Edit Content
    </a>
</div>

{{-- INFO PROPERTI --}}
<div class="card mb-4">
    <div class="card-header">
        <span class="card-header-icon"><i class="fas fa-home"></i></span>
        Informasi Properti
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if($hunian->image)
                    <img src="{{ asset('storage/' . $hunian->image) }}"
                         alt="{{ $hunian->property_name }}"
                         style="width:100%;height:200px;object-fit:cover;border-radius:10px;border:1px solid var(--border);">
                @else
                    <div style="width:100%;height:200px;border-radius:10px;background:var(--bg);border:1px solid var(--border);display:grid;place-items:center;color:var(--muted);">
                        <div class="text-center">
                            <i class="fas fa-image" style="font-size:2rem;margin-bottom:8px;display:block;"></i>
                            <small>Belum ada foto</small>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <table style="width:100%;font-size:.88rem;border-collapse:collapse;">
                    <tr>
                        <td style="padding:8px 0;color:var(--muted);width:140px;font-weight:600;">Nama Properti</td>
                        <td style="padding:8px 0;">{{ $hunian->property_name }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;color:var(--muted);font-weight:600;">Nama Tatar</td>
                        <td style="padding:8px 0;">{{ $hunian->tatar_name ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;color:var(--muted);font-weight:600;">Lokasi</td>
                        <td style="padding:8px 0;">{{ $hunian->location ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;color:var(--muted);font-weight:600;">Badge</td>
                        <td style="padding:8px 0;">
                            <span style="background:linear-gradient(135deg,#c9a84c,#e0c97a);color:#1f2937;font-size:.65rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:4px 12px;border-radius:100px;">
                                ✦ {{ $hunian->badge_label }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- HARGA --}}
<div class="card mb-4">
    <div class="card-header">
        <span class="card-header-icon"><i class="fas fa-tag"></i></span>
        Harga Cicilan
    </div>
    <div class="card-body">
        <div style="display:flex;align-items:baseline;gap:8px;margin-bottom:6px;">
            <span style="color:var(--muted);font-size:.85rem;">Dari</span>
            <span style="font-size:1.5rem;font-weight:800;color:var(--gold,#c9a84c);line-height:1;">
                {{ $hunian->cicilan_format }}
            </span>
            <span style="color:var(--muted);font-size:.85rem;">{{ $hunian->cicilan_unit }}</span>
        </div>
        <small style="color:var(--muted);">{{ $hunian->price_note }}</small>
    </div>
</div>

{{-- BONUS --}}
<div class="card">
    <div class="card-header">
        <span class="card-header-icon"><i class="fas fa-gift"></i></span>
        Bonus &amp; Keuntungan
        <span class="ms-auto badge" style="background:rgba(37,150,190,.12);color:var(--blue2);font-size:.7rem;">
            {{ count($hunian->benefits_list) }} / 4 bonus
        </span>
    </div>
    <div class="card-body">
        @if(count($hunian->benefits_list) > 0)
        <div class="row g-3">
            @foreach($hunian->benefits_list as $b)
            <div class="col-md-3 col-6">
                <div style="background:var(--bg);border:1px solid var(--border);border-radius:10px;padding:14px;text-align:center;">
                    <div style="font-size:.6rem;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:var(--gold,#c9a84c);margin-bottom:4px;">
                        {{ $b['title'] }}
                    </div>
                    <div style="font-size:.82rem;font-weight:600;color:var(--navy);">
                        {{ $b['value'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p class="text-muted mb-0" style="font-size:.85rem;">Belum ada bonus ditambahkan.</p>
        @endif
    </div>
</div>

@endsection
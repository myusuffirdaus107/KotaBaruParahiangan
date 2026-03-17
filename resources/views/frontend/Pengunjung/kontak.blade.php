@extends('frontend.layouts.app')
@section('title', 'Kontak - Properti Kotabaru')

@push('page-styles')
    @vite(['resources/css/pages/kontak.css'])
@endpush

@section('content')

{{--  HERO  --}}
<div class="kt-hero">
    <div class="container-lg px-3 px-lg-5">
        <div class="kt-hero-inner">
            <div>
                <div class="kt-tag"><i class="fas fa-envelope fa-xs"></i> Hubungi Kami</div>
                <h1>Kami Siap<br><em>Membantu Anda</em></h1>
                <p class="kt-hero-desc">Punya pertanyaan tentang properti atau ingin berkonsultasi? Tim kami siap merespons dengan cepat dan profesional.</p>
            </div>
            <div class="kt-quick">
                <a href="tel:+6282274226163" class="kt-qcard">
                    <div class="kt-qcard-ico"><i class="fas fa-phone-alt"></i></div>
                    <div><div class="kt-qcard-lbl">Telepon</div><div class="kt-qcard-val">+62 822 7422 6163</div></div>
                </a>
                <a href="mailto:info@kotabaru.com" class="kt-qcard">
                    <div class="kt-qcard-ico"><i class="fas fa-envelope"></i></div>
                    <div><div class="kt-qcard-lbl">Email</div><div class="kt-qcard-val">info@kotabaru.com</div></div>
                </a>
                <a href="https://wa.me/082274226163" target="_blank" class="kt-qcard">
                    <div class="kt-qcard-ico"><i class="fab fa-whatsapp"></i></div>
                    <div><div class="kt-qcard-lbl">WhatsApp</div><div class="kt-qcard-val">082274226163</div></div>
                </a>
            </div>
        </div>
    </div>
</div>

{{--  MAIN  --}}
<div class="kt-main">
    <div class="container-lg px-3 px-lg-5">
        <div class="text-center mb-5">
            <x-frontend.section-header
                icon="fas fa-phone"
                label="Informasi"
                title="<span>Hubungi</span> Kami"
                :center="true"
            />
        </div>

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><strong>Mohon periksa kembali form Anda!</strong>
            <ul class="mb-0 mt-2">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><strong>Pesan berhasil dikirim!</strong> Tim kami akan segera merespons.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="kt-grid">
            {{-- Info Panel --}}
            <div class="kt-info">
                <div>
                    <div class="kt-info-title">Informasi Kontak</div>
                    <div class="kt-info-sub">Pilih cara terbaik untuk menghubungi kami</div>
                </div>
                <div class="kt-info-divider"></div>
                @foreach([
                    ['icon'=>'fas fa-phone-alt',     'label'=>'Telepon',   'val'=>'<a href="tel:+6282274226163">+62 822 7422 6163</a>'],
                    ['icon'=>'fas fa-envelope',       'label'=>'Email',     'val'=>'<a href="mailto:info@kotabaru.com">info@kotabaru.com</a>'],
                    ['icon'=>'fab fa-whatsapp',       'label'=>'WhatsApp',  'val'=>'<a href="https://wa.me/082274226163" target="_blank">082274226163</a>'],
                    ['icon'=>'fas fa-map-marker-alt', 'label'=>'Alamat',    'val'=>'Jl. Parahyangan No.1, Padalarang,<br>Kab. Bandung Barat, Jawa Barat'],
                ] as $item)
                <div class="kt-info-item">
                    <div class="kt-ii-ico"><i class="{{ $item['icon'] }}"></i></div>
                    <div>
                        <div class="kt-ii-label">{{ $item['label'] }}</div>
                        <div class="kt-ii-val">{!! $item['val'] !!}</div>
                    </div>
                </div>
                @endforeach
                <div class="kt-info-divider"></div>
                <div class="kt-hours">
                    <div class="kt-hours-row"><span class="day">Senin – Jumat</span><span class="time">08:00 – 17:00</span></div>
                    <div class="kt-hours-row"><span class="day">Sabtu</span><span class="time">09:00 – 15:00</span></div>
                    <div class="kt-hours-row"><span class="day">Minggu</span><span class="closed">Tutup</span></div>
                </div>
                <div>
                    <div class="kt-ii-label mb-2" style="color:rgba(255,255,255,.35);">Ikuti Kami</div>
                    <div class="kt-socials">
                        <a href="https://facebook.com/kotabaruproperty" target="_blank" class="kt-social"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com/kotabaruproperty" target="_blank" class="kt-social"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/082274226163" target="_blank" class="kt-social"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.kotabaruproperty.com" target="_blank" class="kt-social"><i class="fas fa-globe"></i></a>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="kt-form-card">
                <div class="kt-form-title">Kirim Pesan</div>
                <div class="kt-form-sub">Isi formulir di bawah dan kami akan membalas dalam 1x24 jam</div>
                <div class="kt-form-divider"></div>
                <form action="{{ route('inquiry.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="kt-field-row">
                        <div class="kt-field">
                            <label>Nama Lengkap <span class="req">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Anda"
                                   class="kt-input @error('name') is-invalid @enderror" required>
                            @error('name')<div class="kt-invalid">{{ $message }}</div>@enderror
                        </div>
                        <div class="kt-field">
                            <label>Nomor Telepon <span class="req">*</span></label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+62 8xx"
                                   class="kt-input @error('phone') is-invalid @enderror" required>
                            @error('phone')<div class="kt-invalid">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="kt-field">
                        <label>Email <span class="req">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com"
                               class="kt-input @error('email') is-invalid @enderror" required>
                        @error('email')<div class="kt-invalid">{{ $message }}</div>@enderror
                    </div>
                    <div class="kt-field">
                        <label>Subjek <span class="req">*</span></label>
                        <select name="subject" class="kt-input @error('subject') is-invalid @enderror" required>
                            <option value="">-- Pilih Subjek --</option>
                            @foreach(['Informasi Properti','Penawaran Khusus','Pertanyaan Umum','Kerjasama Bisnis','Lainnya'] as $s)
                            <option value="{{ $s }}" {{ old('subject') == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('subject')<div class="kt-invalid">{{ $message }}</div>@enderror
                    </div>
                    <div class="kt-field">
                        <label>Pesan <span class="req">*</span></label>
                        <textarea name="message" placeholder="Tuliskan pesan Anda..."
                                  class="kt-input @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                        @error('message')<div class="kt-invalid">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="kt-submit">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--  MAP  --}}
<div class="kt-map-section">
    <div class="container-lg px-3 px-lg-5">
        <div class="kt-map-head">
            <x-frontend.section-header
                icon="fas fa-map"
                label="Lokasi"
                title="Temukan <span>Kantor Kami</span>"
                :center="true"
            />
        </div>
        <div class="kt-map-wrap">
            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?width=900&height=460&hl=en&q=Jl.+Wangsaniaga+Wetan+No.26,+Kertajaya,+Kec.+Padalarang,+Kabupaten+Bandung+Barat,+Jawa+Barat+40553&t=&z=15&ie=UTF8&iwloc=B&output=embed">
            </iframe>
        </div>
    </div>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
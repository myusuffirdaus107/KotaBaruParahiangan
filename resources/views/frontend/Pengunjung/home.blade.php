@extends('frontend.layouts.app')
@section('title', 'Home - Properti Kotabaru')

{{-- CSS & JS halaman ini --}}
@push('page-styles')
    @vite(['resources/css/pages/home.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@push('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @vite(['resources/js/pages/home.js'])
@endpush

@section('content')

{{-- HERO --}}
<div class="hero">
    <div class="hero-swiper swiper">
        <div class="swiper-wrapper">
            @forelse($sliders as $slider)
                <div class="swiper-slide hero-slide"
                     style="background-image:url('{{ asset('storage/'.$slider->image) }}')">
                    <div class="hero-body">
                        <div class="hero-tag">Properti Kotabaru</div>
                        <h1>{{ $slider->title ?? 'Selamat Datang ke Properti Kotabaru' }}</h1>
                        @if($slider->subtitle)<p>{{ $slider->subtitle }}</p>@endif
                        <a href="{{ route('properties.hunian') }}" class="hero-cta">
                            <i class="fas fa-search"></i> Jelajahi Properti
                        </a>
                    </div>
                </div>
            @empty
                @foreach([
                    ['img'=>'photo-1449844908441-8829872d2607','title'=>'Hunian Impian Anda Ada Di Sini','sub'=>'Temukan properti terbaik di kawasan Kotabaru Parahyangan.'],
                    ['img'=>'photo-1560448204-e02f11c3d0e2','title'=>'Properti Premium, Nilai Investasi Tinggi','sub'=>'Lokasi strategis dengan fasilitas lengkap untuk keluarga modern.'],
                    ['img'=>'photo-1486325212027-8081e485255e','title'=>'Kualitas Terbaik di Kelasnya','sub'=>'Dibangun pengembang terpercaya dengan standar internasional.'],
                ] as $s)
                <div class="swiper-slide hero-slide"
                     style="background-image:url('https://images.unsplash.com/{{ $s['img'] }}?w=1400&h=800&fit=crop')">
                    <div class="hero-body">
                        <div class="hero-tag">Properti Kotabaru</div>
                        <h1>{{ $s['title'] }}</h1>
                        <p>{{ $s['sub'] }}</p>
                        <a href="{{ route('properties.hunian') }}" class="hero-cta">
                            <i class="fas fa-search"></i> Jelajahi Properti
                        </a>
                    </div>
                </div>
                @endforeach
            @endforelse
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>

{{-- SERVICES --}}
<div class="container-lg px-3 px-lg-5">
    <section class="py-5">
        <x-frontend.section-header
            icon="fas fa-th-large"
            label="Layanan Kami"
            title="Temukan Properti <span>Impian Anda</span>"
            :center="true"
        />
        <div class="click-hint mb-4 mt-2">
            <i class="fas fa-hand-pointer me-1"></i> Klik kartu untuk menjelajahi
        </div>
        <div class="row g-3">
            @foreach([
                ['href' => route('properties.hunian'),  'icon' => 'fas fa-home',     'title' => 'Hunian Residensial', 'desc' => 'Temukan rumah tapak dan kluster eksklusif dengan desain modern di kawasan terpadu Kotabaru Parahyangan.',  'cta' => 'Lihat Hunian'],
                ['href' => route('properties.business'),'icon' => 'fas fa-building',  'title' => 'Properti Bisnis',    'desc' => 'Ruang komersial strategis di tiga zona — Resort, Town Center & Regional — untuk investasi jangka panjang.', 'cta' => 'Lihat Bisnis'],
                ['href' => route('about'),               'icon' => 'fas fa-users',     'title' => 'Fasilitas',          'desc' => 'Kenali kami lebih dalam dan lihat fasilitas yang tersedia.',                                                'cta' => 'Pelajari'],
            ] as $svc)
            <div class="col-md-4 {{ $loop->last ? 'col-12' : 'col-sm-6' }}">
                <a href="{{ $svc['href'] }}" class="svc-card h-100">
                    <div class="svc-icon-wrap"><i class="{{ $svc['icon'] }} svc-icon"></i></div>
                    <h3>{{ $svc['title'] }}</h3>
                    <p>{{ $svc['desc'] }}</p>
                    <span class="svc-arrow">{{ $svc['cta'] }} <i class="fas fa-arrow-right ms-1"></i></span>
                </a>
            </div>
            @endforeach
        </div>
    </section>
</div>

{{-- FEATURED LAUNCHING --}}
@if($launchings->count() > 0)
@php $featured = $launchings->sortByDesc('launch_date')->first(); @endphp
<div class="fc-section">
    <div class="container-lg px-3 px-lg-5">
        <x-frontend.section-header
            icon="fas fa-star"
            label="New Launching"
            title="Hunian <span style='color:var(--gold)'>Unggulan</span> Kami"
            :dark="true"
        />
        <div class="fc-card">
            <div class="fc-left">
                <img src="{{ $featured->image ? asset('storage/'.$featured->image) : 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=900&h=700&fit=crop' }}"
                     alt="{{ $featured->title }}">
                <div class="fc-left-overlay"></div>
                <div class="fc-img-footer">
                    <div class="fc-img-badge">
                        <i class="fas fa-map-marker-alt fa-xs"></i>
                        {{ $featured->location ?? 'Jl. Ahmad Yani, Kotabaru' }}
                    </div>
                    <h2 class="fc-img-title">KOTA BARU PARAHYANGAN</h2>
                    <p class="fc-img-sub">{{ $featured->title }}</p>
                </div>
            </div>
            <div class="fc-right">
                <div>
                    <div class="fc-new-badge">✦ New Launching</div>
                    <div class="fc-price-label">Cicilan Mulai</div>
                    <div class="fc-price-row">
                        <span class="fc-price-from">Dari</span>
                        <span class="fc-price-num">16</span>
                        <div class="fc-price-unit"><span>Juta / bulan</span></div>
                    </div>
                    <p class="fc-price-note">*Harga dapat berubah sewaktu-waktu</p>
                    <div class="fc-divider"></div>
                    <div class="fc-benefits-label">Bonus & Keuntungan</div>
                    <div class="fc-benefits">
                        @foreach(['Sport Club 1 Tahun','CCTV System','Yoga Voucher 5Jt','Smart Door Lock'] as $b)
                        <div class="fc-benefit">
                            <div class="bt">Free</div>
                            <div class="bv">{{ $b }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <x-frontend.btn-gold
                    :href="route('brochure')"
                    icon="fas fa-file-pdf"
                    label="Download E-Brochure"
                />
            </div>
        </div>
    </div>
</div>
@endif

{{-- EXPANSIVE LIVING --}}
@if($launchings->count() > 0)
<div class="section-gray py-5">
    <div class="container-lg px-3 px-lg-5">
        <div class="benefit-grid">
            <div class="benefit-img-wrap">
                <img src="{{ $featured->image ? asset('storage/'.$featured->image) : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=900&h=700&fit=crop' }}"
                     alt="Expansive Living">
                <div class="soft-dp-badge"><i class="fas fa-check-circle"></i> Soft DP Tersedia</div>
            </div>
            <div>
                <x-frontend.section-header
                    icon="fas fa-gem"
                    label="Keunggulan Produk"
                    title="Experience your <span>Expansive Living</span>"
                />
                <ul class="benefit-list">
                    @foreach(['Free PPN 100%','Soft DP','Free Canopy','Free Smart Door Lock','Free Smarthome System','Free Logam Mulia up to 15gr','Free Mobil BYD Seal*','Free Motor Alva Cervo*'] as $b)
                    <li><span class="ico"><i class="fas fa-check"></i></span>{{ $b }}</li>
                    @endforeach
                </ul>
                <x-frontend.btn-gold
                    :href="route('brochure')"
                    icon="fas fa-download"
                    label="Download E-Brochure"
                />
            </div>
        </div>
    </div>
</div>
@endif

{{-- LAUNCHING LAINNYA --}}
@php $otherLaunchings = $launchings->sortByDesc('launch_date')->take(3); @endphp
@if($otherLaunchings->count() > 0)
<div class="container-lg px-3 px-lg-5">
    <section class="py-5">
        <div class="d-flex align-items-end justify-content-between mb-4 flex-wrap gap-2">
            <x-frontend.section-header
                icon="fas fa-rocket"
                label="Launching Lainnya"
                title="Properti <span>Terbaru</span> dari Kami"
            />
            <a href="{{ route('launching') }}" class="see-all">
                Lihat Lebih Banyak <i class="fas fa-arrow-up-right-from-square ms-1"></i>
            </a>
        </div>
        <div class="row g-3">
            @foreach($otherLaunchings as $l)
            <div class="col-md-4 col-6">
                <a href="{{ route('launching') }}" class="lp-card h-100">
                    <div class="lp-card-img h-190">
                        <img src="{{ $l->image ? asset('storage/'.$l->image) : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600&h=400&fit=crop' }}"
                             alt="{{ $l->title }}" loading="lazy">
                        <x-frontend.status-pill :status="$l->status === 'active' ? 'active' : 'soon'" />
                    </div>
                    <div class="lp-card-body">
                        <h3>{{ $l->title }}</h3>
                        <div class="meta">
                            @if($l->location)<span><i class="fas fa-map-marker-alt"></i> {{ $l->location }}</span>@endif
                            @if($l->developer)<span><i class="fas fa-building"></i> {{ $l->developer }}</span>@endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endif

{{-- HUNIAN UNGGULAN --}}
@if(isset($featuredProperties) && $featuredProperties->count() > 0)
<div class="section-gray py-5">
    <div class="container-lg px-3 px-lg-5">
        <div class="d-flex align-items-end justify-content-between mb-4 flex-wrap gap-2">
            <x-frontend.section-header
                icon="fas fa-home"
                label="Hunian Kami"
                title="Hunian <span>Unggulan</span>"
            />
            <a href="{{ route('properties.hunian') }}" class="see-all">
                Lihat Lebih Banyak <i class="fas fa-arrow-up-right-from-square ms-1"></i>
            </a>
        </div>
        <div class="row g-3">
            @foreach($featuredProperties->take(3) as $property)
            <div class="col-md-4 col-sm-6 col-12">
                <x-frontend.property-card
                    :property="$property"
                    imageHeight="h-210"
                    :href="route('properties.hunian')"
                />
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- CONTACT --}}
<div class="container-lg px-3 px-lg-5">
    <section class="py-5 mb-4" id="contact">
        <div class="contact-wrap">
            <x-frontend.section-header
                icon="fas fa-envelope"
                label="Hubungi Kami"
                title="Kami Siap <span>Membantu</span> Anda"
                subtitle="Isi formulir atau hubungi tim kami langsung."
            />

            @if(session('success'))
                <div class="alert alert-success mt-3">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            <div class="row g-4 g-lg-5 mt-2">
                <div class="col-lg-7">
                    <form action="{{ route('inquiry.store') }}" method="POST" id="contactForm">
                        @csrf
                        <input type="hidden" name="property_id" value="">

                        <div class="form-field mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Masukkan nama Anda"
                                   value="{{ old('name') }}" required>
                            @error('name')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-field mb-3">
                            <label>Nomor Telepon</label>
                            <input type="tel" name="phone" placeholder="+62 812 345 6789"
                                   value="{{ old('phone') }}" required>
                            @error('phone')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-field mb-3">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="email@example.com"
                                   value="{{ old('email') }}" required>
                            @error('email')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-field mb-3">
                            <label>Pesan</label>
                            <textarea name="message" placeholder="Tulis pesan Anda..." required minlength="10">{{ old('message') }}</textarea>
                            @error('message')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>

                        <div style="display:flex; gap:10px; flex-wrap:wrap;">
                            <button type="submit" class="btn-submit" style="flex:1; min-width:180px;">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                            </button>
                            <a href="https://wa.me/082274226163?text={{ urlencode('Halo, saya ingin bertanya mengenai properti Kotabaru Parahyangan.') }}"
                               target="_blank"
                               class="btn-submit"
                               style="flex:1; min-width:180px; background:linear-gradient(135deg,#22c55e,#16a34a); display:inline-flex; align-items:center; justify-content:center; text-decoration:none;">
                                <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="info-group">
                        <h4>Informasi Kontak</h4>
                        <ul class="info-list">
                            <li><a href="tel:+628123456789"><span class="ic"><i class="fas fa-phone"></i></span>+62 812 345 6789</a></li>
                            <li><a href="mailto:info@kotabaru.com"><span class="ic"><i class="fas fa-envelope"></i></span>info@kotabaru.com</a></li>
                        </ul>
                    </div>
                    <div class="info-group">
                        <h4>Media Sosial</h4>
                        <ul class="info-list">
                            <li><a href="https://www.kotabaruproperty.com" target="_blank"><span class="ic"><i class="fas fa-globe"></i></span>www.kotabaruproperty.com</a></li>
                            <li><a href="https://instagram.com/kotabaruproperty" target="_blank"><span class="ic"><i class="fab fa-instagram"></i></span>@kotabaruproperty</a></li>
                            <li><a href="https://facebook.com/kotabaruproperty" target="_blank"><span class="ic"><i class="fab fa-facebook"></i></span>Kotabaru Property</a></li>
                            <li><a href="https://wa.me/082274226163" target="_blank"><span class="ic"><i class="fab fa-whatsapp"></i></span>082274226163</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- WA FLOATING --}}
<x-frontend.wa-floating />

@endsection
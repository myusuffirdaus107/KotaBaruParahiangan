@extends('frontend.layouts.app')

@section('title', 'Kawasan - Properti Kotabaru')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 60px 30px;
        margin-bottom: 50px;
        border-radius: 10px;
    }
    
    .page-header h1 {
        color: white;
        font-size: 2.8rem;
        margin-bottom: 10px;
    }
    
    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .content-section {
        margin-bottom: 60px;
    }
    
    .content-section h2 {
        margin-bottom: 30px;
        font-size: 2rem;
        color: var(--dark-color);
    }
    
    .info-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border-left: 4px solid var(--accent-color);
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .info-card h3 {
        color: var(--primary-color);
        margin-bottom: 15px;
    }
    
    .info-card p {
        color: #6b7280;
        line-height: 1.8;
    }
    
    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin: 40px 0;
    }
    
    .feature-box {
        background: linear-gradient(135deg, #f8fafc 0%, white 100%);
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }
    
    .feature-box:hover {
        transform: translateY(-8px);
        border-color: var(--accent-color);
        box-shadow: 0 12px 30px rgba(245, 158, 11, 0.15);
    }
    
    .feature-icon {
        font-size: 3rem;
        color: var(--accent-color);
        margin-bottom: 15px;
    }
    
    .feature-box h4 {
        color: var(--dark-color);
        margin-bottom: 10px;
    }
    
    .feature-box p {
        color: #9ca3af;
        font-size: 0.95rem;
    }
</style>
@endsection

@section('content')
<div class="container-lg">
    {{-- Page Header --}}
    <div class="page-header">
        <h1><i class="fas fa-map"></i> Informasi Kawasan</h1>
        <p>Ketahui lebih banyak tentang lokasi strategis &amp; fasilitas di sekitar kawasan Kotabaru</p>
    </div>

    {{-- Lokasi Strategis Section --}}
    <section class="content-section">
        <h2><i class="fas fa-location-dot"></i> Lokasi Strategis</h2>
        <div class="info-card">
            <h3>Posisi Geografis Sempurna</h3>
            <p>
                Kotabaru merupakan kawasan yang terletak di lokasi strategis dengan akses mudah ke berbagai pusat kegiatan.
                Jaraknya yang ideal dari pusat kota memberikan keseimbangan antara ketenangan hunian dan aksesibilitas yang baik.
                Kawasan ini terus berkembang dengan infrastruktur yang semakin modern dan lengkap.
            </p>
        </div>
        
        <div class="info-card">
            <h3>Aksesibilitas &amp; Transportasi</h3>
            <p>
                Kawasan Kotabaru dapat diakses melalui berbagai rute transportasi utama, menjadikannya mudah dijangkau.
                Dengan dekat ke jalan toll dan jalur transportasi publik, mobilitas penghuni sangat terjamin.
                Waktu tempuh ke berbagai destinasi penting relatif singkat dan efisien.
            </p>
        </div>
    </section>

    {{-- Fasilitas Section --}}
    <section class="content-section">
        <h2><i class="fas fa-building"></i> Fasilitas Lengkap</h2>
        <div class="feature-grid">
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h4>Pusat Perbelanjaan</h4>
                <p>Mall dan pusat perbelanjaan berkualitas dengan berbagai brand ternama</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <h4>Fasilitas Kesehatan</h4>
                <p>Rumah sakit modern dan klinik dengan pelayanan kesehatan terpercaya</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-school"></i>
                </div>
                <h4>Pendidikan Berkualitas</h4>
                <p>Sekolah dan universitas ternama dengan standar pendidikan internasional</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-tree"></i>
                </div>
                <h4>Ruang Hijau</h4>
                <p>Taman dan area rekreasi untuk aktifitas keluarga sehari-hari</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <h4>Olahraga &amp; Wellness</h4>
                <p>Fasilitas gym, kolam renang, dan lapangan olahraga modern</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h4>Restoran &amp; Cafe</h4>
                <p>Berbagai pilihan tempat makan dari lokal hingga internasional</p>
            </div>
        </div>
    </section>

    {{-- Lingkungan Section --}}
    <section class="content-section">
        <h2><i class="fas fa-leaf"></i> Lingkungan &amp; Komunitas</h2>
        <div class="info-card">
            <h3>Komunitas yang Solid</h3>
            <p>
                Kawasan Kotabaru memiliki komunitas penghuni yang aktif dan solid. Berbagai kegiatan sosial dan 
                acara komunitas diadakan secara rutin untuk mempererat hubungan antar penghuni. Keamanan lingkungan 
                juga menjadi prioritas utama dengan sistem keamanan yang modern dan terpercaya.
            </p>
        </div>

        <div class="info-card">
            <h3>Keberlanjutan Lingkungan</h3>
            <p>
                Kawasan ini dikembangkan dengan mempertimbangkan nilai-nilai keberlanjutan lingkungan. Terdapat 
                banyak area hijau, sistem pengelolaan air, dan inisiatif ramah lingkungan lainnya. Komitmen terhadap 
                pembangunan berkelanjutan membuat kawasan ini semakin layak untuk ditinggali jangka panjang.
            </p>
        </div>
    </section>

    {{-- Future Development --}}
    <section class="content-section">
        <h2><i class="fas fa-chart-line"></i> Perkembangan Masa Depan</h2>
        <div class="info-card">
            <h3>Rencana Pengembangan</h3>
            <p>
                Kawasan Kotabaru terus mengalami perkembangan positif dengan berbagai proyek infrastruktur yang sedang 
                berlangsung dan akan datang. Pembangunan ini akan meningkatkan nilai properti dan kualitas hidup penghuni. 
                Investasi di kawasan ini adalah keputusan yang tepat untuk masa depan.
            </p>
        </div>
    </section>

    {{-- CTA Section --}}
    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); 
                padding: 60px 30px; border-radius: 15px; text-align: center; color: white; margin: 60px 0;">
        <h2 style="color: white; margin-bottom: 20px;">Tertarik Memiliki Properti di Kawasan Kotabaru?</h2>
        <p style="font-size: 1.1rem; margin-bottom: 30px; opacity: 0.95;">
            Konsultasikan kebutuhan properti Anda dengan tim profesional kami
        </p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('properties.hunian') }}" class="btn" style="background: white; color: var(--primary-color); font-weight: 600; padding: 12px 35px; border: none; border-radius: 6px;">
                <i class="fas fa-search"></i> Cari Hunian
            </a>
            <a href="{{ route('kontak') }}" class="btn" style="background: var(--accent-color); color: white; font-weight: 600; padding: 12px 35px; border: none; border-radius: 6px;">
                <i class="fas fa-phone"></i> Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection

@extends('frontend.layouts.app')

@section('title', 'Kontak - Properti Kotabaru')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 80px 30px;
        margin-bottom: 60px;
        text-align: center;
        border-bottom: 5px solid #f59e0b;
    }
    
    .page-header h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .page-header p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin: 0;
    }

    .contact-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 80px;
    }

    @media (max-width: 992px) {
        .contact-wrapper {
            grid-template-columns: 1fr;
            gap: 40px;
        }
    }

    /* Info Cards */
    .info-card {
        background: white;
        border-radius: 16px;
        padding: 40px 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border-top: 4px solid #f59e0b;
    }

    .info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(30, 58, 138, 0.15);
    }

    .info-card h2 {
        font-size: 1.8rem;
        color: #1f2937;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-card h2 i {
        color: #f59e0b;
        font-size: 2rem;
    }

    .info-item {
        margin-bottom: 25px;
        display: flex;
        gap: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .info-content h3 {
        color: #1f2937;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .info-content p {
        color: #6b7280;
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .info-content a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .info-content a:hover {
        color: #1e3a8a;
        transform: translateX(5px);
    }

    .social-links {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid #f59e0b;
    }

    .social-links h4 {
        color: #1f2937;
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 1.1rem;
    }

    .social-icons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .social-icons a {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e5e7eb 0%, #f3f4f6 100%);
        border-radius: 10px;
        color: #1e3a8a;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1.3rem;
    }

    .social-icons a:hover {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        transform: translateY(-5px);
    }

    /* Contact Form */
    .form-card {
        background: white;
        border-radius: 16px;
        padding: 40px 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border-top: 4px solid #3b82f6;
    }

    .form-card h2 {
        font-size: 1.8rem;
        color: #1f2937;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-card h2 i {
        color: #3b82f6;
        font-size: 2rem;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 0.95rem;
        display: block;
    }

    .form-control,
    .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3b82f6;
        background-color: white;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 8px;
        display: block;
        font-weight: 500;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 150px;
        font-family: 'Poppins', sans-serif;
    }

    .btn-submit {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(30, 58, 138, 0.3);
        color: white;
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    /* Alerts */
    .alert {
        border: none;
        border-radius: 12px;
        border-left: 4px solid;
        margin-bottom: 24px;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert-success {
        background-color: #d1fae5;
        border-left-color: #10b981;
        color: #065f46;
    }

    .alert-success i {
        color: #10b981;
    }

    .alert-danger {
        background-color: #fee2e2;
        border-left-color: #ef4444;
        color: #991b1b;
    }

    .alert-danger i {
        color: #ef4444;
    }

    /* Map Container */
    .map-section {
        margin-top: 80px;
        margin-bottom: 60px;
    }

    .map-section h2 {
        text-align: center;
        font-size: 2.5rem;
        color: #1f2937;
        margin-bottom: 40px;
        position: relative;
        padding-bottom: 20px;
    }

    .map-section h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        border-radius: 2px;
    }

    .map-container {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        height: 500px;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
    
    @media (max-width: 768px) {
        .page-header {
            padding: 50px 20px;
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
        }
        
        .page-header p {
            font-size: 1rem;
        }

        .facilities-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .facility-items-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        }

        .modal-header h5 {
            font-size: 1.3rem;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1><i class="fas fa-envelope"></i> Hubungi Kami</h1>
    <p>Kami siap membantu Anda. Hubungi kami melalui formulir di bawah ini</p>
</div>

<div class="container-lg" style="margin-bottom: 80px;">
    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <strong>Mohon periksa kembali form Anda!</strong>
            <ul style="margin-bottom: 0; margin-top: 10px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong>Pesan berhasil dikirim!</strong> Terima kasih telah menghubungi kami. Tim kami akan segera merespons pesan Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="contact-wrapper">
        <!-- Contact Info Card -->
        <div class="info-card">
            <h2><i class="fas fa-phone"></i> Informasi Kontak</h2>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="info-content">
                    <h3>Telepon</h3>
                    <p>
                        <a href="tel:+62123456789">+62 (123) 456-789</a>
                    </p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="info-content">
                    <h3>Email</h3>
                    <p>
                        <a href="mailto:info@kotabaru.com">info@kotabaru.com</a>
                    </p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="info-content">
                    <h3>Alamat</h3>
                    <p>Jl. Sudirman No. 123<br>Kotabaru, West Java 40000<br>Indonesia</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="info-content">
                    <h3>Jam Operasional</h3>
                    <p>
                        Senin - Jumat: 08:00 - 17:00<br>
                        Sabtu: 09:00 - 15:00<br>
                        Minggu: Tutup
                    </p>
                </div>
            </div>

            <div class="social-links">
                <h4>Ikuti Kami</h4>
                <div class="social-icons">
                    <a href="https://facebook.com" target="_blank" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me" target="_blank" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Form Card -->
        <div class="form-card">
            <h2><i class="fas fa-pen-fancy"></i> Kirim Pesan</h2>
            
            <form action="{{ route('inquiry.store') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap Anda"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="Masukkan alamat email Anda"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Nomor Telepon <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="tel" 
                        class="form-control @error('phone') is-invalid @enderror" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone') }}"
                        placeholder="Masukkan nomor telepon Anda"
                        required
                    >
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">Subjek <span style="color: #ef4444;">*</span></label>
                    <select 
                        class="form-select @error('subject') is-invalid @enderror" 
                        id="subject" 
                        name="subject"
                        required
                    >
                        <option value="">-- Pilih Subjek --</option>
                        <option value="Informasi Properti" {{ old('subject') == 'Informasi Properti' ? 'selected' : '' }}>Informasi Properti</option>
                        <option value="Penawaran Khusus" {{ old('subject') == 'Penawaran Khusus' ? 'selected' : '' }}>Penawaran Khusus</option>
                        <option value="Pertanyaan Umum" {{ old('subject') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                        <option value="Kerjasama Bisnis" {{ old('subject') == 'Kerjasama Bisnis' ? 'selected' : '' }}>Kerjasama Bisnis</option>
                        <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">Pesan <span style="color: #ef4444;">*</span></label>
                    <textarea 
                        class="form-control @error('message') is-invalid @enderror" 
                        id="message" 
                        name="message" 
                        rows="5"
                        placeholder="Tuliskan pesan Anda di sini..."
                        required
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="container-lg map-section">
    <h2><i class="fas fa-map"></i> Lokasi Kami</h2>
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5471819968767!2d107.01676231531447!3d-6.9271189929999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6c6c6c6c6c7%3A0x1234567890abcdef!2sKota%20Baru%20Parahyangan!5e0!3m2!1sid!2sid!4v1684756800000" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            style="border: 0;">
        </iframe>
    </div>
</div>

@endsection

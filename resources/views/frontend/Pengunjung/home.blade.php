@extends('frontend.layouts.app')

@section('title', 'Home - Properti Kotabaru')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    * {
        box-sizing: border-box;
    }

    /* Color Variables */
    :root {
        --primary-dark: #1a5a7f;
        --primary-light: #2a7baa;
        --accent-yellow: #d4af37;
        --dark-text: #1f2937;
        --gray-text: #6b7280;
        --light-gray: #f3f4f6;
        --border-color: #e5e7eb;
    }

    .container-lg {
        padding: 0 20px;
    }

    /* Hero Banner */
    .hero-banner-section {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        width: 100vw;
        margin: 0;
        margin-bottom: 60px;
    }

    .hero-swiper {
        width: 100%;
        height: 500px;
    }

    .hero-slide {
        position: relative;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(26, 90, 127, 0.2) 0%, rgba(30, 58, 138, 0.15) 100%);
        z-index: 1;
    }

    .hero-slide-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
    }

    .hero-slide-content h1 {
        font-size: 3.2rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 3px 3px 12px rgba(0, 0, 0, 0.4);
        letter-spacing: 1px;
        line-height: 1.3;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: white;
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 20px;
        font-weight: 800;
    }

    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.5);
        opacity: 1;
        transition: all 0.3s ease;
    }

    .swiper-pagination-bullet-active {
        background: white;
        width: 30px;
        border-radius: 10px;
    }

    /* Hero Header Section */
    .hero-header-section {
        background: linear-gradient(135deg, #f5f3f0 0%, #ede8e2 100%);
        padding: 50px 40px;
        text-align: center;
        margin-bottom: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .hero-header-section .subtitle {
        color: #b8b3a8;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .hero-header-section h1 {
        color: #a89a8a;
        font-size: 2.5rem;
        margin: 0;
        font-weight: 800;
        letter-spacing: 2px;
    }

    /* Hero Project Image */
    .hero-project-image {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 60px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .hero-project-image:hover {
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    .hero-project-image img {
        width: 100%;
        height: 450px;
        display: block;
        object-fit: cover;
    }

    .ebrochure-badge-hero {
        position: absolute;
        bottom: 25px;
        right: 25px;
        background: linear-gradient(135deg, #d4af37 0%, #e0c158 100%);
        color: #1f2937;
        padding: 12px 22px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .ebrochure-badge-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
    }

    /* Launching Card Section */
    .launching-main-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 50px;
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        gap: 0;
        transition: all 0.3s ease;
    }

    .launching-main-card:hover {
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }

    .launching-card-image {
        position: relative;
        background: #f0f0f0;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 300px;
    }

    .launching-card-image img {
        width: 100%;
        height: 100%;
        border-radius: 18px;
        object-fit: cover;
    }

    .launching-card-body {
        background: linear-gradient(135deg, #1a5a7f 0%, #2a7baa 100%);
        color: white;
        padding: 45px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }

    .launching-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #d4af37;
        color: #1f2937;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    }

    .launching-logo {
        width: 55px;
        height: 55px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.6rem;
    }

    .launching-card-body h2 {
        color: white;
        font-size: 1.4rem;
        margin: 0 0 8px 0;
        font-weight: 800;
        line-height: 1.4;
        letter-spacing: 0.5px;
    }

    .launching-card-body h3 {
        color: #e0d4af;
        font-size: 1rem;
        margin: 0 0 25px 0;
        font-weight: 400;
        letter-spacing: 2px;
    }

    .cicilan-section {
        background: rgba(0, 0, 0, 0.2);
        padding: 20px 24px;
        border-radius: 14px;
        margin-bottom: 20px;
    }

    .cicilan-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #d4af37;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .cicilan-amount {
        font-size: 1.8rem;
        font-weight: 800;
        color: white;
        display: flex;
        align-items: baseline;
        gap: 12px;
        margin-bottom: 12px;
    }

    .cicilan-amount span:last-child {
        font-size: 0.9rem;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.9);
    }

    .cicilan-benefits {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .benefit-item {
        background: rgba(255, 255, 255, 0.1);
        padding: 10px 12px;
        border-radius: 8px;
        font-size: 0.7rem;
        text-align: center;
        line-height: 1.3;
        font-weight: 500;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* Center E-Brochure Button */
    .ebrochure-center {
        text-align: center;
        margin-bottom: 70px;
    }

    .btn-ebrochure {
        background: linear-gradient(135deg, #d4af37 0%, #e0c158 100%);
        color: #1f2937;
        border: none;
        padding: 14px 40px;
        border-radius: 30px;
        font-weight: 800;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
    }

    .btn-ebrochure:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(212, 175, 55, 0.4);
        background: linear-gradient(135deg, #e0c158 0%, #d4af37 100%);
    }

    /* Experience Card Section */
    .experience-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 70px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        transition: all 0.3s ease;
    }

    .experience-card:hover {
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }

    .experience-card-images {
        position: relative;
        background: linear-gradient(135deg, #f5f3f0 0%, #ede8e2 100%);
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .images-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 12px;
        width: 100%;
    }

    .images-grid img {
        border-radius: 14px;
        object-fit: cover;
        width: 100%;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .images-grid img:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .images-grid img:first-child {
        grid-row: span 2;
        min-height: 280px;
    }

    .images-grid img:nth-child(2),
    .images-grid img:nth-child(3) {
        min-height: 134px;
    }

    .soft-dp-badge {
        position: absolute;
        bottom: 30px;
        left: 30px;
        background: #22a047;
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 6px 15px rgba(34, 160, 71, 0.3);
        transition: all 0.3s ease;
    }

    .soft-dp-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(34, 160, 71, 0.4);
    }

    .soft-dp-badge i {
        font-size: 1.1rem;
    }

    .experience-card-content {
        padding: 50px 45px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .experience-card-content h2 {
        color: #1f2937;
        font-size: 1.8rem;
        margin: 0 0 30px 0;
        font-weight: 800;
        line-height: 1.4;
        letter-spacing: 0.5px;
    }

    .experience-features {
        list-style: none;
        padding: 0;
        margin: 0 0 35px 0;
    }

    .experience-features li {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 13px;
        padding-left: 0;
        line-height: 1.6;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .experience-features li:before {
        content: '✓';
        color: #22a047;
        font-weight: 800;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Contact Form Section */
    .contact-form-section {
        background: white;
        padding: 60px 50px;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 80px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: start;
    }

    .contact-form-section h3 {
        grid-column: 1 / -1;
        color: #1f2937;
        margin-bottom: 40px;
        text-align: center;
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .contact-form-wrapper {
        grid-column: 1;
    }

    .contact-form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .contact-form-grid.full {
        grid-column: 1 / -1;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        color: #1f2937;
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 0.9rem;
        letter-spacing: 0.3px;
    }

    .form-group input,
    .form-group textarea {
        padding: 12px 16px;
        border: 2px solid #d4d4d8;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        color: #1f2937;
        background: #fafafa;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #a1a1a1;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #22a047;
        box-shadow: 0 0 0 3px rgba(34, 160, 71, 0.1);
        background: white;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .btn-submit {
        background: linear-gradient(135deg, #22a047 0%, #1d8f3f 100%);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 8px;
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        width: 100%;
        margin-top: 15px;
        box-shadow: 0 8px 20px rgba(34, 160, 71, 0.25);
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #1d8f3f 0%, #22a047 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(34, 160, 71, 0.35);
    }

    .social-section {
        grid-column: 2;
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .social-section > div {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* WhatsApp Floating Button & Popup */
    .whatsapp-floating-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #25d366 0%, #20ba5a 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        transition: all 0.3s ease;
        z-index: 999;
        border: none;
        color: white;
        font-size: 28px;
    }

    .whatsapp-floating-btn:hover {
        transform: scale(1.1) translateY(-5px);
        box-shadow: 0 12px 35px rgba(37, 211, 102, 0.6);
    }

    /* WhatsApp Popup Modal */
    .whatsapp-popup-overlay {
        position: fixed;
        bottom: 100px;
        right: 20px;
        background: transparent;
        display: block;
        z-index: 1050;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        pointer-events: none;
    }

    .whatsapp-popup-overlay.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .whatsapp-popup-content {
        background: white;
        border-radius: 12px;
        padding: 0;
        width: 420px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.22);
        position: relative;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        max-height: 600px;
        animation: popupSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes popupSlideIn {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .whatsapp-popup-header-top {
        background: linear-gradient(135deg, #25d366 0%, #1fc860 100%);
        color: white;
        padding: 24px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        position: relative;
    }

    .whatsapp-popup-header-top-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
    }

    .whatsapp-popup-header-top-text {
        flex: 1;
    }

    .whatsapp-popup-header-top-text p {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.4;
    }

    .whatsapp-popup-close {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        font-size: 22px;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 50%;
        padding: 0;
    }

    .whatsapp-popup-close:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .whatsapp-popup-contacts {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        max-height: 380px;
        overflow-y: auto;
    }

    .whatsapp-popup-contacts::-webkit-scrollbar {
        width: 6px;
    }

    .whatsapp-popup-contacts::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .whatsapp-popup-contacts::-webkit-scrollbar-thumb {
        background: #25d366;
        border-radius: 10px;
    }

    .whatsapp-contact-item {
        background: #f9f9f9;
        border: 1px solid #e8e8e8;
        border-radius: 10px;
        padding: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
    }

    .whatsapp-contact-item:hover {
        background: #f0f0f0;
        border-color: #25d366;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.15);
    }

    .whatsapp-contact-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #25d366 0%, #1fc860 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        flex-shrink: 0;
    }

    .whatsapp-contact-info {
        flex: 1;
    }

    .whatsapp-contact-name {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 0.95rem;
        margin: 0 0 4px 0;
    }

    .whatsapp-contact-number {
        color: #666;
        font-size: 0.85rem;
        margin: 0;
    }

    .whatsapp-contact-button {
        background: linear-gradient(135deg, #25d366 0%, #1fc860 100%);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        flex-shrink: 0;
        text-decoration: none;
        display: inline-block;
    }

    .whatsapp-contact-button:hover {
        background: linear-gradient(135deg, #1fc860 0%, #1ab854 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    }

    @media (max-width: 480px) {
        .whatsapp-popup-overlay {
            right: 15px;
            bottom: 90px;
        }

        .whatsapp-popup-content {
            width: calc(100vw - 30px);
            max-width: 420px;
        }

        .whatsapp-contact-button {
            padding: 6px 12px;
            font-size: 0.75rem;
        }
    }



    .social-section h4 {
        color: #1f2937;
        margin: 0;
        font-weight: 800;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .social-links {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .social-links a {
        color: #1f2937;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .social-links a:hover {
        color: #22a047;
    }

    .social-links a i {
        font-size: 1.3rem;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f0f0;
        border-radius: 50%;
        color: #22a047;
    }

    @media (max-width: 768px) {
        .contact-form-section {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .contact-form-wrapper {
            grid-column: 1;
        }

        .social-section {
            grid-column: 1;
        }
    }

    .social-links i {
        color: #2a7baa;
        font-size: 1.15rem;
        width: 24px;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        color: #2a7baa;
        padding-left: 8px;
    }

    .social-links a:hover i {
        transform: translateX(4px);
    }

    @media (max-width: 768px) {
        .launching-main-card,
        .experience-card {
            grid-template-columns: 1fr;
        }

        .contact-form-grid,
        .social-section {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .experience-card-content {
            padding: 40px 30px;
        }

        .contact-form-section {
            padding: 40px 25px;
        }

        .hero-banner h1 {
            font-size: 2rem;
        }

        .hero-header-section h1 {
            font-size: 1.8rem;
        }

        .experience-card-content h2 {
            font-size: 1.4rem;
        }
    }
</style>
@endsection

@section('content')
{{-- Slide Home --}}
<div class="hero-banner-section">
    <div class="hero-swiper swiper">
        <div class="swiper-wrapper">
            @forelse($sliders as $slider)
                <div class="swiper-slide hero-slide" style="background-image: url('{{ asset('storage/' . $slider->image) }}');">
                    <div class="hero-slide-content">
                        <h1>{{ $slider->title ?? 'Selamat Datang ke Properti Kotabaru' }}</h1>
                    </div>
                </div>
            @empty
                <div class="swiper-slide hero-slide" style="background-image: url('https://images.unsplash.com/photo-1449844908441-8829872d2607?w=1400&h=600&fit=crop');">
                    <div class="hero-slide-content">
                        <h1>Selamat Datang ke Properti Kotabaru</h1>
                    </div>
                </div>
                <div class="swiper-slide hero-slide" style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1400&h=600&fit=crop');">
                    <div class="hero-slide-content">
                        <h1>Properti Impian Anda Dimulai Di Sini</h1>
                    </div>
                </div>
                <div class="swiper-slide hero-slide" style="background-image: url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1400&h=600&fit=crop');">
                    <div class="hero-slide-content">
                        <h1>Kualitas Premium Dengan Harga Terjangkau</h1>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>

{{-- Launching Section --}}
    @if($launchings->count() > 0)
        @php $featured = $launchings->first(); @endphp

    

    <div class="container-lg">

        <!-- Main Card Section - Premium with White Border -->
        <div style="background: linear-gradient(135deg, #1e5a8e 0%, #1a4d7a 100%); border-radius: 26px; overflow: hidden; margin-bottom: 70px; box-shadow: 0 22px 65px rgba(0,0,0,0.23); position: relative; display: grid; grid-template-columns: 1.2fr 0.8fr; min-height: 360px; align-items: stretch; border: 5px solid white; max-width: 980px; margin-left: auto; margin-right: auto;">

            <!-- Left Side - Image with Curved Edge -->
            <div style="position: relative; height: 100%; overflow: hidden; background: linear-gradient(135deg, #2a6ba8 0%, #1f5a8f 100%);">
                @if($featured->image)
                    <img src="https://images.unsplash.com/photo-1449844908441-8829872d2607?w=1400&h=600&fit=crop" alt="{{ $featured->title }}"
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 80px; color: rgba(255,255,255,0.1);"></i>
                    </div>
                @endif

                <!-- Curved Divider -->
                <div style="position: absolute; top: 0; right: -4px; width: 40px; height: 100%; background: linear-gradient(135deg, #1e5a8e 0%, #1a4d7a 100%); border-radius: 30px 0 0 30px;"></div>
            </div>

            <!-- Right Side - Content Premium -->
            <div style="padding: 32px 28px; display: flex; flex-direction: column; justify-content: center; position: relative;">

                <!-- Brand Logo Circle -->
                <div style="position: absolute; top: 16px; left: 16px; width: 40px; height: 40px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #1e5a8e; font-weight: 900; box-shadow: 0 4px 14px rgba(0,0,0,0.12);">
                    K
                </div>

                <!-- Badge -->
                <div style="position: absolute; top: 16px; right: 16px; background: linear-gradient(135deg, #d4af37 0%, #e0c158 100%); color: #1f2937; padding: 7px 14px; border-radius: 21px; font-size: 0.62rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.9px; z-index: 10; box-shadow: 0 3px 10px rgba(212, 175, 55, 0.28);">
                    New Launching
                </div>

                <!-- Location Label -->
                <p style="color: rgba(255,255,255,0.85); font-size: 0.68rem; text-transform: uppercase; letter-spacing: 2px; margin: 0 0 10px 0; font-weight: 800;">{{ $featured->location ?? 'JL. SUDIRMAN' }}</p>

                <!-- Main Title -->
                <h1 style="color: white; font-size: 1.95rem; margin: 0 0 6px 0; font-weight: 900; line-height: 1.12; letter-spacing: -0.2px;">KOTA BARU<br>PARAHYANGAN</h1>

                <!-- Subtitle -->
                <p style="color: rgba(255,255,255,0.9); font-size: 0.92rem; margin: 0 0 20px 0; font-weight: 600; letter-spacing: 0.15px;">{{ $featured->title }}</p>

                <!-- Pricing Box -->
                <div style="background: rgba(0,0,0,0.25); border: 1.8px solid rgba(255,255,255,0.15); border-radius: 14px; padding: 15px 13px; margin-bottom: 16px; backdrop-filter: blur(10px);">
                    <p style="color: rgba(255,255,255,0.7); font-size: 0.62rem; text-transform: uppercase; letter-spacing: 0.9px; margin: 0 0 7px 0; font-weight: 800;">Cicilan</p>
                    <div style="display: flex; align-items: baseline; gap: 3px;">
                        <p style="color: white; font-size: 0.73rem; font-weight: 700;">DARI</p>
                        <p style="color: #d4af37; font-size: 2.4rem; margin: 0; font-weight: 900; line-height: 1;">16</p>
                        <div style="display: flex; flex-direction: column; gap: 0;">
                            <p style="color: white; font-size: 0.73rem; margin: 0; font-weight: 700;">JUTA</p>
                            <p style="color: rgba(255,255,255,0.7); font-size: 0.68rem; margin: 0; font-weight: 600;">/bln</p>
                        </div>
                    </div>
                </div>

                <!-- Benefits Grid - Pill Style -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 9px;">
                    <!-- Free Sport Club -->
                    <div style="background: #f5e6d3; padding: 12px 10px; border-radius: 17px; text-align: center; transition: all 0.3s ease; box-shadow: 0 2px 6px rgba(0,0,0,0.06);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.09)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.06)';">
                        <p style="color: #d4af37; font-size: 0.62rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.35px; margin: 0 0 2px 0;">Free</p>
                        <p style="color: #1f2937; font-size: 0.66rem; margin: 0; font-weight: 700; line-height: 1.18;">Sport Club<br>1 Tahun</p>
                    </div>

                    <!-- Free CCTV -->
                    <div style="background: #f5e6d3; padding: 12px 10px; border-radius: 17px; text-align: center; transition: all 0.3s ease; box-shadow: 0 2px 6px rgba(0,0,0,0.06);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.09)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.06)';">
                        <p style="color: #d4af37; font-size: 0.62rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.35px; margin: 0 0 2px 0;">Free</p>
                        <p style="color: #1f2937; font-size: 0.66rem; margin: 0; font-weight: 700; line-height: 1.18;">CCTV<br>System</p>
                    </div>

                    <!-- Free Yoga Voucher -->
                    <div style="background: #f5e6d3; padding: 12px 10px; border-radius: 17px; text-align: center; transition: all 0.3s ease; box-shadow: 0 2px 6px rgba(0,0,0,0.06);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.09)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.06)';">
                        <p style="color: #d4af37; font-size: 0.62rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.35px; margin: 0 0 2px 0;">Free</p>
                        <p style="color: #1f2937; font-size: 0.66rem; margin: 0; font-weight: 700; line-height: 1.18;">Yoga<br>Voucher 5J</p>
                    </div>

                    <!-- Free Smart Door -->
                    <div style="background: #f5e6d3; padding: 12px 10px; border-radius: 17px; text-align: center; transition: all 0.3s ease; box-shadow: 0 2px 6px rgba(0,0,0,0.06);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.09)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.06)';">
                        <p style="color: #d4af37; font-size: 0.62rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.35px; margin: 0 0 2px 0;">Free</p>
                        <p style="color: #1f2937; font-size: 0.66rem; margin: 0; font-weight: 700; line-height: 1.18;">Smart<br>Door Lock</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- E-Brochure Button - Centered -->
        <div style="text-align: center; margin-bottom: 65px;">
            <a href="#contact" style="display: inline-flex; align-items: center; justify-content: center; gap: 7px; background: linear-gradient(135deg, #c4a032 0%, #d4af37 100%); color: #1f2937; padding: 11px 28px; border-radius: 21px; text-decoration: none; font-weight: 800; text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.85px; box-shadow: 0 5px 18px rgba(196, 160, 50, 0.28); transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 8px 24px rgba(196, 160, 50, 0.38)'; this.style.transform='translateY(-1px)';" onmouseout="this.style.boxShadow='0 5px 18px rgba(196, 160, 50, 0.28)'; this.style.transform='translateY(0)';">
                <i class="fas fa-file-pdf"></i> E - Brochure
            </a>
        </div>

        <!-- Benefits List Section -->
        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 50px; align-items: flex-start; margin-bottom: 80px;">

            <!-- Left - Image with Content -->
            <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                @if($featured->image)
                    <div style="position: relative; height: 300px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1449844908441-8829872d2607?w=1400&h=600&fit=crop" alt="{{ $featured->title }}"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @endif
                <div style="padding: 30px;">
                    <div style="display: inline-block; background: #66a657; color: white; padding: 8px 14px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 15px;">
                        Soft DP
                    </div>
                    <h3 style="color: #1f2937; font-size: 1.5rem; margin: 0 0 15px 0; font-weight: 800; line-height: 1.3;">Experience your Expansive Living Spaces</h3>
                </div>
            </div>

            <!-- Right - Benefits List -->
            <div>
                <h3 style="color: #1f2937; font-size: 1.3rem; margin: 0 0 25px 0; font-weight: 700;">Keunggulan Produk</h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="color: #374151; margin: 0 0 12px 0; font-size: 0.95rem; line-height: 1.5;">Free PPN 100%</li>
                    <li style="color: #374151; margin: 0 0 12px 0; font-size: 0.95rem; line-height: 1.5;">Soft DP</li>
                    <li style="color: #374151; margin: 0 0 12px 0; font-size: 0.95rem; line-height: 1.5;">Free Canopy</li>
                    <li style="color: #374151; margin: 0 0 12px 0; font-size: 0.95rem; line-height: 1.5;">Free Smart Door Lock</li>
                    <li style="color: #374151; margin: 0 0 12px 0; font-size: 0.95rem; line-height: 1.5;">Free Smarthome System</li>
                    <li style="color: #374151; margin: 0 0 12px 0; font-size: 0.95rem; line-height: 1.5;">Free Logam Mulia up to 15gr</li>
                    <li style="color: #374151; margin: 0 0 12px 0; font-size: 0.95rem; line-height: 1.5;">Free Mobil BYD Seal*</li>
                    <li style="color: #374151; margin: 0; font-size: 0.95rem; line-height: 1.5;">Free Motor Alva Cervo*</li>
                </ul>

                <!-- E-Brochure Button -->
                <div style="margin-top: 40px;">
                    <a href="#contact" class="btn-ebrochure" style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: #d4af37; color: #1f2937; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                        <i class="fas fa-download"></i> E-Brochure
                    </a>
                </div>
            </div>
        </div>

        {{-- Other Launchings --}}
        @if($launchings->count() > 1)
        <div style="margin-bottom: 80px;">
            <div style="text-align: center; margin-bottom: 50px;">
                <h2 style="color: #1f2937; font-size: 2rem; margin: 0 0 10px 0; font-weight: 800;">Launching Lainnya</h2>
                <p style="color: #9ca3af; margin: 0; font-size: 0.95rem;">Pilihan properti eksklusif kami yang lain</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                @foreach($launchings as $launching)
                <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08);" class="launching-other-card">
                    <div style="position: relative; height: 220px; background: #d4c5b0; overflow: hidden;">
                        @if($launching->image)
                            <img src="{{ Storage::url($launching->image) }}" alt="{{ $launching->title }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-image" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 80px; color: rgba(0,0,0,0.1);"></i>
                        @endif
                        <div style="position: absolute; top: 12px; right: 12px;">
                            @if($launching->status === 'active')
                                <span style="display: inline-block; background: #10b981; color: white; padding: 6px 12px; border-radius: 15px; font-size: 0.75rem; font-weight: 700;">
                                    Aktif
                                </span>
                            @else
                                <span style="display: inline-block; background: #f59e0b; color: white; padding: 6px 12px; border-radius: 15px; font-size: 0.75rem; font-weight: 700;">
                                    Coming Soon
                                </span>
                            @endif
                        </div>
                    </div>
                    <div style="padding: 22px;">
                        <h3 style="color: #1f2937; font-size: 1.1rem; margin: 0 0 10px 0; font-weight: 700;">{{ $launching->title }}</h3>
                        @if($launching->location)
                            <p style="color: #9ca3af; font-size: 0.85rem; margin: 0 0 6px 0;">
                                <i class="fas fa-map-marker-alt" style="margin-right: 5px; color: #d4c5b0;"></i>{{ $launching->location }}
                            </p>
                        @endif
                        @if($launching->developer)
                            <p style="color: #6b7280; font-size: 0.8rem; margin: 0;">
                                <i class="fas fa-building" style="margin-right: 5px; color: #d4c5b0;"></i>{{ $launching->developer }}
                            </p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endif

    {{-- Contact Form Section --}}
    <section class="contact-form-section" id="contact">
        <h3>Hubungi Kami</h3>

        <div class="contact-form-wrapper">
            <form id="contactForm">
                <div class="contact-form-grid">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" placeholder="+62 812 345 6789" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="email@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </form>
        </div>

        {{-- Social Media Section --}}
        <div class="social-section">
            <div>
                <h4>MORE INFORMATION</h4>
                <div class="social-links">
                    <a href="tel:+62822742261636">
                        <i class="fas fa-phone"></i> +62 812 345 6789
                    </a>
                    <a href="mailto:info@kotabaru.com">
                        <i class="fas fa-envelope"></i> info@kotabaru.com
                    </a>
                </div>
            </div>
            <div>
                <h4>OUR SOCIAL MEDIA</h4>
                <div class="social-links">
                    <a href="https://www.kotabaruproperty.com" target="_blank">
                        <i class="fas fa-globe"></i> www.kotabaruproperty.com
                    </a>
                    <a href="https://www.instagram.com/kotabaruproperty" target="_blank">
                        <i class="fab fa-instagram"></i> @kotabaruproperty
                    </a>
                    <a href="https://www.facebook.com/kotabaruproperty" target="_blank">
                        <i class="fab fa-facebook"></i> Kotabaru Property
                    </a>
                    <a href="https://www.youtube.com/kotabaruproperty" target="_blank">
                        <i class="fab fa-youtube"></i> Kotabaru Property
                    </a>
                    <a href="https://wa.me/082274226163" target="_blank">
                        <i class="fab fa-whatsapp"></i> 08882929739
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Hero Slider
    var heroSwiper = new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true,
        },
    });

    // Contact Form
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;
        const message = document.getElementById('message').value;

        // WhatsApp link
        const whatsappLink = `https://wa.me/082274226163?text=Halo, nama saya ${name}, nomor saya ${phone}. ${message}`;
        window.open(whatsappLink, '_blank');
    });

    // WhatsApp Popup - SIMPEL DAN PASTI BERFUNGSI
    setTimeout(function() {
        const whatsappBtn = document.querySelector('.whatsapp-floating-btn');
        const whatsappOverlay = document.querySelector('.whatsapp-popup-overlay');
        const whatsappClose = document.querySelector('.whatsapp-popup-close');

        if (!whatsappBtn || !whatsappOverlay || !whatsappClose) {
            console.error('WhatsApp popup elements not found');
            return;
        }

        // Buka popup saat button diklik
        whatsappBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Button clicked');
            whatsappOverlay.classList.add('active');
        });

        // Tutup popup saat close button diklik
        whatsappClose.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Close button clicked');
            whatsappOverlay.classList.remove('active');
        });

        // Tutup popup saat tekan ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                whatsappOverlay.classList.remove('active');
            }
        });

        // Tutup popup saat klik area luar (overlay)
        whatsappOverlay.addEventListener('click', function(e) {
            if (e.target === whatsappOverlay) {
                whatsappOverlay.classList.remove('active');
            }
        });

        console.log('WhatsApp popup initialized successfully');
    }, 500);


</script>

<!-- WhatsApp Floating Button -->
<button class="whatsapp-floating-btn" title="Chat dengan kami via WhatsApp">
    <i class="fab fa-whatsapp"></i>
</button>

<!-- WhatsApp Popup Modal -->
<div class="whatsapp-popup-overlay">
    <div class="whatsapp-popup-content">
        <div class="whatsapp-popup-header-top">
            <div class="whatsapp-popup-header-top-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
            <div class="whatsapp-popup-header-top-text">
                <p>Selamat Datang di Website Sinar Terang Abadi</p>
            </div>
            <button class="whatsapp-popup-close">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="whatsapp-popup-contacts">
            <!-- Contact 1 -->
            <div class="whatsapp-contact-item">
                <div class="whatsapp-contact-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="whatsapp-contact-info">
                    <p class="whatsapp-contact-name">Tim Penjualan</p>
                    <p class="whatsapp-contact-number">082274226163</p>
                </div>
                <a href="https://wa.me/082274226163?text=Halo, saya ingin menanyakan tentang properti Anda" target="_blank" class="whatsapp-contact-button">
                    Hubungi
                </a>
            </div>

            <!-- Contact 2 -->
            <div class="whatsapp-contact-item">
                <div class="whatsapp-contact-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="whatsapp-contact-info">
                    <p class="whatsapp-contact-name">Tim Support</p>
                    <p class="whatsapp-contact-number">082274226163</p>
                </div>
                <a href="https://wa.me/082274226163?text=Saya membutuhkan bantuan dan informasi lebih lanjut" target="_blank" class="whatsapp-contact-button">
                    Hubungi
                </a>
            </div>

            <!-- Contact 3 -->
            <div class="whatsapp-contact-item">
                <div class="whatsapp-contact-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="whatsapp-contact-info">
                    <p class="whatsapp-contact-name">Customer Service</p>
                    <p class="whatsapp-contact-number">082274226163</p>
                </div>
                <a href="https://wa.me/082274226163?text=Halo, saya ingin informasi jadwal kunjungan lokasi" target="_blank" class="whatsapp-contact-button">
                    Hubungi
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
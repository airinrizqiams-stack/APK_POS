@extends('layouts.app')

@section('content')

@include('layouts.navbar')
<style>
    :root {
        --cafe-primary: #493628;
        --cafe-secondary: #1a120b;
        --cafe-accent: #d5cea3;
        --cafe-card-bg: #ffffff;
        --cafe-text-muted: #6b5b52;
        --cafe-border: #ab886d;
    }

    body {
        background-color: #e5e5e5;
    }

    .about-card {
        background-color: var(--cafe-card-bg);
        border: 1px solid var(--cafe-border);
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(73, 54, 40, 0.08);
        transition: transform 0.3s ease;
    }

    .about-card:hover {
        transform: translateY(-3px);
    }

    .text-cafe-title {
        color: var(--cafe-primary);
        font-weight: 800;
    }

    .text-cafe-muted {
        color: var(--cafe-text-muted);
    }

    .btn-back-custom {
        background-color: #ffffff;
        color: var(--cafe-primary);
        border: 1px solid var(--cafe-border);
        font-weight: 600;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(73, 54, 40, 0.05);
    }

    .btn-back-custom:hover {
        background-color: var(--cafe-primary);
        color: #ffffff;
        border-color: var(--cafe-primary);
    }

    .social-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background-color: #f5f0eb;
        color: var(--cafe-primary);
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid var(--cafe-border);
    }

    .social-btn:hover {
        background-color: var(--cafe-primary);
        color: #ffffff;
        transform: scale(1.1);
    }

    .badge-accent {
        background-color: #f5f0eb;
        color: var(--cafe-primary);
        border: 1px solid var(--cafe-border);
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 20px;
    }

    .cafe-hero-img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        border-radius: 16px;
        border: 1px solid var(--cafe-border);
    }
</style>

{{-- CDN FontAwesome untuk Ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container py-5">
    {{-- Header Section --}}
    <div class="text-center mb-4">
        <span class="badge-accent mb-2 d-inline-block">Cita Rasa & Hangatnya Suasana</span>
        <h1 class="text-cafe-title display-5 fw-bold mb-3">Tentang Airin Cafe</h1>
        <p class="text-cafe-muted mx-auto" style="max-width: 650px; font-size: 1.1rem;">
            Tempat terbaik menikmati seduhan kopi otentik, matcha yang creamy, serta aneka sajian dessert manis yang siap melengkapi momen santai Anda.
        </p>
    </div>

    {{-- Photo Banner Section --}}
    <div class="mb-5">
        <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?q=80&w=1200&auto=format&fit=crop" 
            alt="Suasana Airin Cafe" 
            class="cafe-hero-img shadow-sm">
    </div>

    {{-- Main Content Section --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="about-card p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid me-2 fa-mug-hot fs-3" style="color: var(--cafe-primary);"></i>
                    <h4 class="text-cafe-title m-0">Cerita Kami</h4>
                </div>
                <p class="text-cafe-muted lh-lg" style="font-size: 0.95rem;">
                    Berdiri dengan semangat menyajikan kenikmatan terbaik, <strong>Airin Cafe</strong> menghadirkan racikan khusus varian kopi pilihan, matcha berkualitas, hingga pilihan sajian <em>dessert</em> manis. Setiap menu dibuat untuk memberikan kehangatan dan rasa manis yang pas di setiap momen bersantai Anda.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="about-card p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-heart me-2 fs-3" style="color: var(--cafe-primary);"></i>
                    <h4 class="text-cafe-title m-0">Komitmen Layanan</h4>
                </div>
                <p class="text-cafe-muted lh-lg" style="font-size: 0.95rem;">
                    Diintegrasikan langsung dengan sistem manajemen POS modern, kami menjamin pelayanan yang cepat, tepat, dan ramah. Kepuasan serta kenyamanan setiap pengunjung adalah prioritas utama dari setiap racikan hidangan kami.
                </p>
            </div>
        </div>
    </div>

    {{-- Info & Social Media Footer Card --}}
    <div class="about-card p-4 p-md-5 text-center mb-4">
        <h4 class="text-cafe-title mb-3">Tetap Terhubung Bersama Kami</h4>
        <p class="text-cafe-muted mb-4">
            Dapatkan pembaruan menu terbaru, promo menarik, dan kehangatan harian Airin Cafe.
        </p>

        {{-- Social Media Icons --}}
        <div class="d-flex justify-content-center gap-3 mb-4">
            <a href="https://instagram.com/airinrizlads19" target="_blank" class="social-btn" title="Instagram @airinrizlads19">
                <i class="fab fa-instagram fs-5"></i>
            </a>
            <a href="https://tiktok.com/@airinrizlads19" target="_blank" class="social-btn" title="TikTok @airinrizlads19">
                <i class="fab fa-tiktok fs-5"></i>
            </a>
            <a href="https://wa.me/6281234567890" target="_blank" class="social-btn" title="WhatsApp Airin Cafe">
                <i class="fab fa-whatsapp fs-5"></i>
            </a>
            <a href="https://maps.google.com/?q=SMK+Negeri+4+Tasikmalaya" target="_blank" class="social-btn" title="Lokasi SMKN 4 Tasikmalaya">
                <i class="fas fa-location-dot fs-5"></i>
            </a>
        </div>

        <hr style="border-color: var(--cafe-border); opacity: 0.3;" class="my-4">

        <div class="row text-cafe-muted small">
            <div class="col-md-4 mb-2 mb-md-0">
                <i class="far fa-clock me-1"></i> Buka Setiap Hari: 09.00 - 22.00 WIB
            </div>
            <div class="col-md-4 mb-2 mb-md-0">
                <i class="fas fa-location-dot me-1"></i> SMKN 4 Tasikmalaya
            </div>
            <div class="col-md-4">
                <i class="fas fa-envelope me-1"></i> airincafe@gmail.com
            </div>
        </div>
    </div>

    <div class="text-center pt-2">
        <a href="{{ route('dashboard') }}" class="btn-back-custom">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
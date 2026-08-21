<!-- memanggil file app.blade.php--> 
@extends('layouts.app') 

<!-- mengirimkan nilai ke title untuk ditampilkan --> 
@section('title', 'Login - POS System') 

<!-- batas awal isi konten --> 
@section('content') 
<!-- Memanggil Bootstrap Icons via CDN untuk ikon mata -->
<link rel="stylesheet" href="https://jsdelivr.net">

<style>
    :root {
        --color-bg: #E4E0E1;
        --color-card: #D6C0B3;
        --color-primary: #493628;
        --color-border: #AB886D;
        --color-muted: #6B5B52;
    }

    body {
        background-color: var(--color-bg) !important;
        font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        background: #FFFFFF;
        border: 1px solid var(--color-border);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(73, 54, 40, 0.08);
        width: 100%;
        max-width: 420px;
        padding: 2.5rem 2rem;
        transition: all 0.3s ease;
    }

    /* Text Hierarchy */
    .login-title {
        color: var(--color-primary);
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .login-subtitle {
        color: var(--color-muted);
        font-size: 0.95rem;
        font-weight: 400;
        margin-bottom: 2rem;
    }

    .form-label {
        color: var(--color-primary);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        text-align: left;
    }

    /* Input Customization */
    .form-control-custom {
        border: 1.5px solid var(--color-border);
        border-radius: 8px !important;
        font-size: 0.95rem;
        background-color: #FAFAFA;
        width: 100% !important;
        height: 45px !important;
        outline: none;
        transition: all 0.2s ease;
        display: block;
    }

    .form-control-custom:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 0.25rem rgba(73, 54, 40, 0.15) !important;
        background-color: #FFFFFF;
    }

    /* Toggle Password Button */
    .btn-toggle-password {
        position: absolute !important;
        right: 15px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        background: transparent !important;
        border: none !important;
        color: var(--color-muted) !important;
        padding: 0 !important;
        font-size: 1.3rem !important;
        cursor: pointer !important;
        z-index: 999 !important;
        line-height: 1 !important;
        height: auto !important;
        width: auto !important;
    }

    .btn-toggle-password:hover {
        color: var(--color-primary) !important;
    }

    /* Button Style */
    .btn-submit {
        background-color: var(--color-primary);
        border: none;
        color: #FFFFFF;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        width: 100%;
        margin-top: 1rem;
        transition: background-color 0.2s ease;
    }

    .btn-submit:hover {
        background-color: #35271d;
        color: #FFFFFF;
    }

    .error-feedback {
        font-size: 0.8rem;
        color: #dc3545;
        margin-top: 0.25rem;
        text-align: left;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <!-- Header dengan Hierarki Teks -->
        <div class="text-center">
            <h1 class="login-title">Masuk Aplikasi POS</h1>
            <p class="login-subtitle">Silakan akses akun Anda untuk mengelola transaksi</p>
        </div>

        <!-- Form Login -->
        <form action="{{ route('auth') }}" method="POST">
            @csrf 
            
            <!-- Input Email -->
            <div class="mb-3" style="text-align: left;">
                <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control-custom" id="exampleInputEmail1" placeholder="nama@perusahaan.com" value="{{ old('email') }}" style="padding: 0.65rem 1rem;">
                @error('email')
                    <div class="error-feedback">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <!-- Input Password dengan Tombol Mata -->
            <div class="mb-4" style="text-align: left;">
                <label for="exampleInputPassword1" class="form-label">Kata Sandi</label>
                <div style="position: relative; width: 100%; display: block;">
                    <input type="password" name="password" class="form-control-custom" id="exampleInputPassword1" placeholder="Masukkan kata sandi" style="padding: 0.65rem 3rem 0.65rem 1rem;">
                    <button type="button" class="btn-toggle-password" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="error-feedback">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-submit">Masuk ke Sistem</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('exampleInputPassword1');
        const eyeIcon = document.getElementById('eyeIcon');

        if(toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('bi-eye');
                    eyeIcon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('bi-eye-slash');
                    eyeIcon.classList.add('bi-eye');
                }
            });
        }
    });
</script>
@endsection

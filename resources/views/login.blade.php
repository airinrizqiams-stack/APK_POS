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
        --color-primary: #607274;
        --color-bg: #FAEED1;
        --color-card: #FFFFFF;
        --color-muted: #B2A59B;
        --color-border: #DED0B6;
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
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(96, 114, 116, 0.1);
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
    }

    /* Input & Group Customization */
    .input-group-custom {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .form-control-custom {
        border: 1.5px solid var(--color-border);
        border-radius: 8px !important;
        padding: 0.65rem 3rem 0.65rem 1rem; /* Ruang ekstra di kanan untuk tombol mata */
        font-size: 0.95rem;
        background-color: #FAFAFA;
        width: 100%;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.25rem rgba(96, 114, 116, 0.15);
        background-color: #FFFFFF;
    }

    /* Toggle Password Button (Perbaikan Posisi Tengah) */
    .btn-toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--color-muted);
        padding: 0;
        font-size: 1.25rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .btn-toggle-password:hover {
        color: var(--color-primary);
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
        background-color: #4d5c5e;
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
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control-custom" id="exampleInputEmail1" placeholder="nama@perusahaan.com" value="{{ old('email') }}">
                @error('email')
                    <div class="error-feedback">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <!-- Input Password dengan Tombol Mata -->
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Kata Sandi</label>
                <div class="input-group-custom">
                    <input type="password" name="password" class="form-control-custom" id="exampleInputPassword1" placeholder="Masukkan kata sandi">
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

<!-- JavaScript untuk Toggle Intip Password -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('exampleInputPassword1');
        const eyeIcon = document.getElementById('eyeIcon');
        
        // Cek tipe input saat ini
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            // Ubah ikon menjadi mata dicoret
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            // Ubah ikon kembali ke mata biasa
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        }
    });
</script>

<!-- batas Akhir isi konten -->
@endsection

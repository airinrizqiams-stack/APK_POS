@extends('layouts.app') 

@section('title', 'Login') 

@section('content') 

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    .btn-toggle-password {
        position: absolute !important;
        right: 15px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        background: transparent !important;
        border: none !important;
        color: var(--color-muted) !important;
        padding: 0 !important;
        cursor: pointer !important;
        z-index: 999 !important;
        line-height: 1 !important;
        height: auto !important;
        width: auto !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-toggle-password:hover svg {
        fill: var(--color-primary) !important;
    }

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

    /* Pop-up Custom Style */
    .swal-custom-popup {
        border-radius: 20px !important;
        padding: 2rem 1.5rem !important;
        background: #FFFFFF !important;
        border: 1px solid var(--color-border) !important;
        box-shadow: 0 15px 35px rgba(73, 54, 40, 0.15) !important;
    }
    .swal-custom-title {
        color: var(--color-primary) !important;
        font-size: 1.4rem !important;
        font-weight: 700 !important;
        margin-top: 0.5rem !important;
    }
    .swal-custom-html {
        color: var(--color-muted) !important;
        font-size: 0.95rem !important;
        margin-top: 0.75rem !important;
        line-height: 1.5 !important;
    }
    .swal-custom-btn {
        background-color: var(--color-primary) !important;
        color: #FFFFFF !important;
        font-weight: 600 !important;
        border-radius: 10px !important;
        padding: 0.7rem 2.5rem !important;
        font-size: 0.9rem !important;
        box-shadow: 0 4px 12px rgba(73, 54, 40, 0.2) !important;
        transition: all 0.2s ease !important;
    }
    .swal-custom-btn:hover {
        background-color: #35271d !important;
        transform: translateY(-1px);
    }
    .attempts-badge {
        display: inline-block;
        background: #F2E9E1;
        color: var(--color-primary);
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        margin-top: 1rem;
        border: 1px solid var(--color-border);
    }
    .timer-box {
        background-color: #F8D7DA;
        color: #842029;
        font-weight: 700;
        font-size: 1.05rem;
        padding: 0.6rem 1rem;
        border-radius: 10px;
        margin-top: 0.8rem;
        border: 1px solid #F5C2C7;
        display: inline-block;
    }
</style>

<div class="login-container">
    <div class="login-card">

        <div class="text-center">
            <h1 class="login-title">Masuk Aplikasi POS</h1>
            <p class="login-subtitle">Silakan akses akun Anda untuk mengelola transaksi</p>
        </div>

        <form action="{{ route('auth') }}" method="POST">
            @csrf 
            
            <div class="mb-3" style="text-align: left;">
                <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control-custom" id="exampleInputEmail1" placeholder="Masukkan Email" value="{{ old('email') }}" style="padding: 0.65rem 1rem;">
                @error('email')
                    <div class="error-feedback">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4" style="text-align: left;">
                <label for="exampleInputPassword1" class="form-label">Kata Sandi</label>
                <div style="position: relative; width: 100%; display: block;">
                    <input type="password" name="password" class="form-control-custom" id="exampleInputPassword1" placeholder="Masukkan Kata Sandi" style="padding: 0.65rem 3rem 0.65rem 1rem;">
                    <button type="button" class="btn-toggle-password" id="togglePassword">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6B5B52" viewBox="0 0 16 16">
                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <div class="error-feedback">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit">Masuk</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('exampleInputPassword1');
        const eyeIcon = document.getElementById('eyeIcon');

        const eyeOpenPath = `<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>`;
        const eyeSlashPath = `<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/><path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>`;

        if(toggleBtn && passwordInput && eyeIcon) {
            toggleBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.innerHTML = eyeOpenPath;
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.innerHTML = eyeSlashPath;
                }
            });
        }
    });
</script>

<!-- Pop-up Percobaan Kesalahan (1 kali / 2 kali lagi) -->
@if(session('error_type'))
<script>
    Swal.fire({
        icon: 'warning',
        iconColor: '#AB886D',
        title: "{{ session('error_title') }}",
        html: `
            <div>{{ session('error_message') }}</div>
            <div class="attempts-badge">Sisa Percobaan: <strong>{{ session('attempts_left') }}</strong> kali lagi</div>
        `,
        confirmButtonText: 'Coba Lagi',
        customClass: {
            popup: 'swal-custom-popup',
            title: 'swal-custom-title',
            htmlContainer: 'swal-custom-html',
            confirmButton: 'swal-custom-btn'
        },
        buttonsStyling: false
    });
</script>
@endif

<!-- Pop-up Akun Terkunci (Percobaan Ke-3 Habis) -> Timer Countdown 60 Detik -->
@if(session('error_lockout_seconds'))
<script>
    let timeLeft = {{ session('error_lockout_seconds') }};
    let timerInterval;

    Swal.fire({
        icon: 'error',
        iconColor: '#a94442',
        title: 'Akses Terkunci Sementara!',
        html: `
            <div>Batas percobaan login telah habis (3 kali salah). Silakan tunggu hingga waktu selesai untuk mencoba login kembali.</div>
            <div class="timer-box">
                ⏱️ Sisa Waktu: <span id="countdown">${timeLeft} detik</span>
            </div>
        `,
        confirmButtonText: 'Saya Mengerti',
        allowOutsideClick: false,
        customClass: {
            popup: 'swal-custom-popup',
            title: 'swal-custom-title',
            htmlContainer: 'swal-custom-html',
            confirmButton: 'swal-custom-btn'
        },
        buttonsStyling: false,
        didOpen: () => {
            const timerElement = document.getElementById('countdown');
            timerInterval = setInterval(() => {
                timeLeft--;
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerElement.innerText = "Waktu habis! Silakan muat ulang halaman.";
                } else {
                    timerElement.innerText = timeLeft + " detik";
                }
            }, 1000);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    });
</script>
@endif

@endsection
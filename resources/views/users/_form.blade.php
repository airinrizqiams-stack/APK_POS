@csrf

<style>
    .form-label-custom {
        color: var(--color-primary);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        text-align: left;
        margin-bottom: 0.5rem;
    }

    .form-control-custom {
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px !important;
        padding: 0.65rem 1rem !important;
        font-size: 0.95rem !important;
        background-color: #FAFAFA !important;
        width: 100% !important;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 0.25rem rgba(73, 54, 40, 0.15) !important;
        background-color: #FFFFFF !important;
    }

    /* Validasi Error Merah */
    .is-invalid-custom {
        border-color: #dc3545 !important;
    }
    .is-invalid-custom:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15) !important;
    }

    .feedback-error-custom {
        font-size: 0.825rem;
        color: #dc3545;
        margin-top: 0.35rem;
        text-align: left;
        font-weight: 500;
    }

    /* Wadah Relatif Khusus Password */
    .password-wrapper-custom {
        position: relative !important;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
    }

    /* CSS Tombol Mata SVG Modern */
    .btn-toggle-password-custom {
        position: absolute !important;
        right: 15px !important;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        cursor: pointer !important;
        z-index: 99 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: auto !important;
        width: auto !important;
    }
    .btn-toggle-password-custom:hover svg {
        fill: var(--color-primary) !important;
    }

    /* ==========================================================================
       PERBAIKAN CSS TOMBOL (SIMPAN TETAP COKELAT, KEMBALI INTERAKTIF PUTIH-COKELAT)
       ========================================================================== */
    .btn-action-custom {
        font-weight: 600;
        padding: 0.65rem 1.75rem;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    /* Tombol Simpan (TETAP COKELAT SEJAK AWAL) */
    .btn-save-custom {
        background-color: var(--color-primary) !important;
        border: 1.5px solid var(--color-primary) !important;
        color: #FFFFFF !important;
    }
    .btn-save-custom:hover {
        background-color: #35271d !important;
        border-color: #35271d !important;
    }

    /* Tombol Kembali (AWALNYA PUTIH, BERUBAH COKELAT SAAT DIKLIK/HOVER) */
    .btn-back-custom {
        background-color: #FFFFFF !important;
        border: 1.5px solid #5A4B41 !important;
        color: #5A4B41 !important;
    }
    .btn-back-custom:hover, .btn-back-custom:active, .btn-back-custom:focus {
        background-color: #5A4B41 !important;
        color: #FFFFFF !important;
    }
</style>

<!-- Input Nama Lengkap -->
<div class="mb-4">
    <label class="form-label-custom">Nama Lengkap</label>
    <input type="text" name="name"
           class="form-control-custom @error('name') is-invalid-custom @enderror"
           placeholder="Masukkan nama lengkap pengguna"
           value="{{ old('name', $user->name ?? '') }}">
    @error('name')
        <div class="feedback-error-custom">⚠️ {{ $message }}</div>
    @enderror   
</div>

<!-- Input Alamat Email -->
<div class="mb-4">
    <label class="form-label-custom">Alamat Email</label>
    <input type="email" name="email"
           class="form-control-custom @error('email') is-invalid-custom @enderror"
           placeholder="Masukkan Email"
           value="{{ old('email', $user->email ?? '' ) }}">
    @error('email')
        <div class="feedback-error-custom">⚠️ {{ $message }}</div>
    @enderror
</div>

<!-- Input Kata Sandi + Fitur Tombol Mata SVG Terkoreksi -->
<div class="mb-4">
    <label class="form-label-custom">Kata Sandi (Password)</label>
    <div class="password-wrapper-custom">
        <input type="password" name="password" id="inputPasswordForm"
               class="form-control-custom @error('password') is-invalid-custom @enderror"
               placeholder="{{ isset($user) ? 'Kosongkan jika tidak ingin mengubah kata sandi' : 'Masukkan kata sandi minimal 8 karakter' }}" 
               style="padding-right: 3rem !important;">
        <button type="button" class="btn-toggle-password-custom" id="togglePasswordForm">
            <!-- Tautan XMLNS di bawah ini sekarang sudah diperbaiki dengan benar -->
            <svg id="eyeIconForm" xmlns="http://w3.org" width="20" height="20" fill="#6B5B52" viewBox="0 0 16 16">
                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
            </svg>
        </button>
    </div>
    @error('password')
        <div class="feedback-error-custom">⚠️ {{ $message }}</div>
    @enderror
</div>

<!-- Opsi Pilihan Hak Akses -->
<div class="mb-4">
    <label class="form-label-custom">Hak Akses Sistem (Role)</label>
    <select name="role_id"
            class="form-control-custom @error('role_id') is-invalid-custom @enderror" style="appearance: revert;">
        <option value="">-- Pilih Tingkatan Akses --</option>
        @foreach($roles as $role)
           <option value="{{ $role->id }}"
               @selected(old('role_id', $user->role_id ?? '') == $role->id)>
               {{ ucfirst($role->name) }}
           </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="feedback-error-custom">⚠️ {{ $message }}</div>
    @enderror
</div>

<!-- Baris Tombol Submit / Kembali -->
<div class="d-flex align-items-center gap-2 mt-4">
    <button type="submit" class="btn btn-action-custom btn-save-custom">
        Simpan Data
    </button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-action-custom btn-back-custom">
        ← Kembali
    </a>
</div>

<!-- JavaScript Interaksi Intip Sandi Khusus Form -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById('togglePasswordForm');
        const passwordInput = document.getElementById('inputPasswordForm');
        const eyeIcon = document.getElementById('eyeIconForm');

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

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

    /* CSS Tambahan Tombol Mata */
    .btn-toggle-password-custom {
        position: absolute !important;
        right: 15px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        background: transparent !important;
        border: none !important;
        color: var(--color-muted) !important;
        padding: 0 !important;
        font-size: 1.25rem !important;
        cursor: pointer !important;
        z-index: 10 !important;
        line-height: 1 !important;
    }
    .btn-toggle-password-custom:hover {
        color: var(--color-primary) !important;
    }

    /* Tombol Operasional Form */
    .btn-save-custom {
        background-color: var(--color-primary) !important;
        border: none !important;
        color: #FFFFFF !important;
        font-weight: 600;
        padding: 0.65rem 1.75rem;
        border-radius: 8px;
        transition: background-color 0.2s ease;
    }
    .btn-save-custom:hover {
        background-color: #35271d !important;
    }

    .btn-back-custom {
        background-color: transparent !important;
        border: 1.5px solid var(--color-border) !important;
        color: var(--color-primary) !important;
        font-weight: 600;
        padding: 0.65rem 1.5rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .btn-back-custom:hover {
        background-color: rgba(171, 136, 109, 0.1) !important;
        color: var(--color-primary) !important;
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
        <div class="feedback-error-custom"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
    @enderror   
</div>

<!-- Input Alamat Email -->
<div class="mb-4">
    <label class="form-label-custom">Alamat Email</label>
    <input type="email" name="email"
           class="form-control-custom @error('email') is-invalid-custom @enderror"
           placeholder="nama@perusahaan.com"
           value="{{ old('email', $user->email ?? '' ) }}">
    @error('email')
        <div class="feedback-error-custom"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
    @enderror
</div>

<!-- Input Kata Sandi + Fitur Tombol Mata -->
<div class="mb-4">
    <label class="form-label-custom">Kata Sandi (Password)</label>
    <div style="position: relative; width: 100%; display: block;">
        <input type="password" name="password" id="inputPasswordForm"
               class="form-control-custom @error('password') is-invalid-custom @enderror"
               placeholder="Masukkan kata sandi minimal 8 karakter" style="padding-right: 3rem !important;">
        <button type="button" class="btn-toggle-password-custom" id="togglePasswordForm">
            <i class="bi bi-eye" id="eyeIconForm"></i>
        </button>
    </div>
    @error('password')
        <div class="feedback-error-custom"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
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
        <div class="feedback-error-custom"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
    @enderror
</div>

<!-- Baris Tombol Submit / Kembali -->
<div class="d-flex align-items-center gap-2 mt-4">
    <button type="submit" class="btn btn-save-custom"><i class="bi bi-check-lg"></i> Simpan Data</button>
    <a href="{{ route('admin.users') }}" class="btn btn-back-custom"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<!-- JavaScript Interaksi Intip Sandi Khusus Form -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById('togglePasswordForm');
        const passwordInput = document.getElementById('inputPasswordForm');
        const eyeIcon = document.getElementById('eyeIconForm');

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

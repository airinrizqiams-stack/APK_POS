<!-- Upload Gambar & Preview -->
<div class="row mb-4 text-start">
    <div class="col-md-6 mb-3 mb-md-0">
        <label class="form-label-custom">Gambar Produk</label>
        <input type="file" 
               name="foto" 
               onchange="previewImage(this)" 
               class="form-control form-control-custom @error('foto') is-invalid @enderror">
        @error('foto')
            <div class="invalid-feedback d-block mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label-custom">Preview Foto</label>
        <div class="preview-box">
            @if(isset($produk) && $produk->foto)
                <img id="preview" src="{{ asset('storage/' . $produk->foto) }}" class="img-thumbnail" style="max-height: 120px; object-fit: cover;" alt="Preview foto">
                <span id="preview-text" class="text-muted small" style="display:none;">
                    <i class="bi bi-image"></i> Belum ada foto dipilih
                </span>
            @else
                <img id="preview" class="img-thumbnail" style="display:none; max-height: 120px; object-fit: cover;" alt="Preview foto">
                <span id="preview-text" class="text-muted small">
                    <i class="bi bi-image"></i> Belum ada foto dipilih
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row mb-4 text-start">
    <!-- Dropdown Jenis Produk -->
    <div class="col-md-6 mb-3 mb-md-0">
        <label class="form-label-custom">Jenis Produk</label>
        <select name="jenis_id" class="form-select form-control-custom @error('jenis_id') is-invalid @enderror" required>
            <option value="">-- Pilih Jenis Produk --</option>
            @if(isset($jenisList))
                @foreach($jenisList as $jenis)
                    <option value="{{ $jenis->id }}" {{ old('jenis_id', $produk->jenis_id ?? '') == $jenis->id ? 'selected' : '' }}>
                        {{ $jenis->nama_jenis }}
                    </option>
                @endforeach
            @endif
        </select>
        @error('jenis_id')
            <div class="invalid-feedback d-block mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Nama Produk -->
    <div class="col-md-6">
        <label class="form-label-custom">Nama Produk</label>
        <input type="text" 
               name="nama" 
               class="form-control form-control-custom @error('nama') is-invalid @enderror" 
               value="{{ old('nama', $produk->nama ?? '') }}"
               placeholder="Masukkan nama produk..." required>
        @error('nama')
            <div class="invalid-feedback d-block mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<!-- Grid Harga Beli & Harga Jual -->
<div class="row mb-4 text-start">
    <div class="col-md-6 mb-3 mb-md-0">
        <label class="form-label-custom">Harga Beli (Rp)</label>
        <input type="number" 
               name="harga_beli" 
               class="form-control form-control-custom @error('harga_beli') is-invalid @enderror" 
               value="{{ old('harga_beli', $produk->harga_beli ?? '') }}"
               placeholder="Masukkan Harga Beli" required>
        @error('harga_beli')
            <div class="invalid-feedback d-block mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label-custom">Harga Jual (Rp)</label>
        <input type="number" 
               name="harga_jual" 
               class="form-control form-control-custom @error('harga_jual') is-invalid @enderror" 
               value="{{ old('harga_jual', $produk->harga_jual ?? '') }}"
               placeholder="Masukkan Harga Jual" required>
        @error('harga_jual')
            <div class="invalid-feedback d-block mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<!-- Stok -->
<div class="mb-4 text-start">
    <label class="form-label-custom">Jumlah Stok</label>
    <input type="number" 
           name="stok" 
           class="form-control form-control-custom @error('stok') is-invalid @enderror" 
           value="{{ old('stok', $produk->stok ?? '') }}"
           placeholder="Masukkan jumlah stok..." required>
    @error('stok')
        <div class="invalid-feedback d-block mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

<!-- Tombol Aksi -->
<div class="d-flex align-items-center gap-2 pt-2 text-start">
    <button class="btn btn-action-custom btn-save-custom" type="submit">
        <i class="bi bi-save"></i> Simpan
    </button>
    <a href="{{ route('produk.index') }}" class="btn btn-action-custom btn-back-custom">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
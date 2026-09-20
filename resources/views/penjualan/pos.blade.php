@extends('layouts.app')

@section('title', 'Mesin Kasir (POS)')

@section('content')

@include('layouts.navbar')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --color-bg: #E4E0E1;
        --color-card: #FFFFFF;
        --color-primary: #493628;
        --color-border: #AB886D;
        --color-muted: #6B5B52;
    }

    body {
        background-color: var(--color-bg) !important;
        font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
        color: #333333;
    }

    .pos-wrapper {
        padding: 2.5rem 15px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .header-section {
        padding-left: 0.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }

    .main-title {
        color: var(--color-primary);
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
    }

    .main-subtitle {
        color: var(--color-muted);
        font-size: 0.95rem;
        font-weight: 400;
    }

    .card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(73, 54, 40, 0.05);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .card-header-custom {
        background-color: #FAFAFA !important;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 1rem 1.25rem;
        color: var(--color-primary);
        font-weight: 700;
        font-size: 1rem;
        text-align: left;
    }

    .card-body-custom {
        padding: 1.25rem;
    }

    .form-control-custom {
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px !important;
        padding: 0.55rem 1rem;
        font-size: 0.95rem;
        background-color: #FAFAFA;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control-custom:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 0.25rem rgba(73, 54, 40, 0.15) !important;
        background-color: #FFFFFF;
    }

    .btn-product-item {
        background-color: #FFFFFF !important;
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px !important;
        color: var(--color-primary) !important;
        padding: 0.75rem 1rem !important;
        transition: all 0.2s ease;
        text-align: left;
        width: 100%;
    }
    
    .btn-product-item:hover:not([disabled]) {
        border-color: var(--color-primary) !important;
        background-color: rgba(171, 136, 109, 0.05) !important;
    }

    .btn-add-cart-custom {
        background-color: #8E705C !important;
        border: 1.5px solid #8E705C !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 8px !important;
        transition: background-color 0.2s ease;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 !important;
    }

    .btn-add-cart-custom:hover:not([disabled]) {
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
    }

    .table-aesthetic {
        width: 100%;
        margin-bottom: 1.5rem;
        border-collapse: collapse;
    }

    .table-aesthetic th {
        background-color: #FAFAFA !important;
        color: var(--color-primary) !important;
        font-weight: 700;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 0.75rem 0.5rem;
        text-align: left;
    }

    .table-aesthetic td {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #E4E0E1;
        text-align: left;
    }

    .table-qty-input {
        max-width: 60px;
        text-align: center;
        border: 1px solid var(--color-border);
        border-radius: 6px;
        padding: 0.25rem;
        background-color: #FAFAFA;
    }

    .btn-delete-item-custom {
        background-color: #A54A4A !important;
        border: none !important;
        color: #FFFFFF !important;
        font-weight: 600;
        padding: 0.4rem 0.8rem;
        border-radius: 6px !important;
        font-size: 0.85rem;
        transition: background-color 0.2s ease;
    }

    .btn-delete-item-custom:hover {
        background-color: #843b3b !important;
    }

    .select-payment-custom {
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px !important;
        padding: 0.65rem 1rem !important;
        color: var(--color-primary) !important;
        font-weight: 600;
        background-color: #FFFFFF !important;
    }

    .btn-checkout-theme {
        background-color: var(--color-primary) !important;
        border: 1.5px solid var(--color-primary) !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 8px !important;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }

    .btn-checkout-theme:hover:not([disabled]) {
        background-color: #35271d !important;
        border-color: #35271d !important;
    }

    .btn-cancel-theme {
        background-color: #FFFFFF !important;
        border: 1.5px solid #5A4B41 !important;
        color: #5A4B41 !important;
        font-weight: 600;
        border-radius: 8px !important;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease-in-out;
    }

    .btn-cancel-theme:hover:not([disabled]) {
        background-color: #5A4B41 !important;
        color: #FFFFFF !important;
    }

    .qris-card-box {
        border: 2px dashed var(--color-border);
        background-color: #FAFAFA;
        border-radius: 12px;
        padding: 1.25rem;
        text-align: center;
    }
</style>

<div class="pos-wrapper text-start">

    @if(session('errors') || $errors->any())
    <div class="alert alert-danger mb-4" style="border-radius: 8px; text-align: left;">
        <i class="bi bi-exclamation-triangle"></i> 
        @if(session('errors'))
            {{ session('errors') }}
        @else
            {{ $errors->first() }}
        @endif
    </div>
    @endif

    <div class="header-section">
        <h1 class="main-title">
            {{ (isset($mode) && $mode === 'edit') ? 'Ubah Transaksi Penjualan' : 'Entri Transaksi Baru (POS)' }}
        </h1>
        <p class="main-subtitle">Pilih produk katalog, atur jumlah kuantitas belanja, dan proses pembayaran konsumen</p>
    </div>

    <div class="row g-4">

        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="bi bi-box-seam"></i> Pilih Item Katalog Produk
                </div>
                <div class="card-body-custom">

                    <div class="mb-4">
                        <form method="GET" action="{{ route('penjualan.create') }}" id="searchForm">
                            <div class="position-relative">
                                <input type="text" 
                                    id="searchInput"
                                    name="search" 
                                    value="{{ request('search') }}"
                                    class="form-control-custom w-100" 
                                    placeholder="Cari nama produk lalu tekan Enter..."
                                    style="padding-left: 2.5rem !important;" 
                                    autocomplete="off">
                                <i class="bi bi-search position-absolute text-muted" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                            </div>
                        </form>
                    </div>

                    <div style="max-height: 55vh; overflow-y: auto; padding-right: 4px;">
                        @forelse($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="mb-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="row g-2 align-items-stretch">
                                    <div class="col-8">
                                        <button type="button" class="btn btn-product-item h-100" disabled>
                                            <span class="fw-bold d-block" style="color: var(--color-primary);">{{ $product->nama }}</span>
                                            <span class="text-muted small">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                                        </button>
                                    </div>
                                    <div class="col-2">
                                        <input type="number" name="quantity" value="1" min="1" 
                                               class="form-control form-control-custom h-100 text-center" 
                                               {{ (isset($sale) && $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-add-cart-custom" 
                                                {{ (isset($sale) && $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                                            <i class="bi bi-plus-lg fs-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @empty
                            <div class="text-center text-muted py-4">Produk tidak ditemukan.</div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="bi bi-cart3"></i> Rincian Keranjang Belanja
                </div>
                <div class="card-body-custom">
                    
                    <div class="table-responsive" style="max-height: 38vh; overflow-y: auto;">
                        <table class="table table-aesthetic">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th style="width: 80px;">Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($sale) && $sale->itemPenjualan->count() > 0)
                                    @foreach($sale->itemPenjualan as $item)
                                    <tr>
                                        <td>{{ $item->produk->nama }}</td>
                                        <td>Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $item->kuantitas }}" 
                                                       class="table-qty-input" onchange="this.form.submit();" 
                                                       {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                            </form>
                                        </td>
                                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        <td>
                                            @can('delete', $item)
                                            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}" onsubmit="return confirm('Yakin ingin menghapus item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete-item-custom" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                                    Hapus
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">Belum ada item belanjaan di keranjang.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center my-3 pt-3" style="border-top: 1.5px dashed var(--color-border);">
                        <span class="fw-bold" style="color: var(--color-primary);">Total Pembayaran:</span>
                        <strong class="fs-4" style="color: var(--color-primary);">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</strong>
                    </div>

                    @if(isset($sale))
                    <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return validatePayment();">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <select name="payment_method" id="payment_method" class="form-select select-payment-custom w-100" required {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="CASH" {{ (old('payment_method', $sale->metode_pembayaran ?? '') === 'CASH') ? 'selected' : '' }}>Tunai (Cash)</option>
                                <option value="QRIS" {{ (old('payment_method', $sale->metode_pembayaran ?? '') === 'QRIS') ? 'selected' : '' }}>QRIS / Digital Pay (Simulasi)</option>
                                <option value="BAYAR_NANTI" {{ (old('payment_method', $sale->metode_pembayaran ?? '') === 'BAYAR_NANTI') ? 'selected' : '' }}>Bayar Nanti</option>
                            </select>
                        </div>

                        <div id="cash-payment-section" class="mb-3" style="display: none;">
                            <div class="mb-3">
                                <label for="uang_dibayar" class="form-label fw-bold small" style="color: var(--color-primary);">Nominal Bayar (Rp):</label>
                                <input type="number" 
                                       name="uang_dibayar" 
                                       id="uang_dibayar" 
                                       class="form-control form-control-custom" 
                                       placeholder="Masukkan nominal uang bayar..." 
                                       min="0"
                                       value="{{ old('uang_dibayar', $sale->uang_dibayar ?? '') }}"
                                       {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small" style="color: var(--color-primary);">Kembalian:</label>
                                <input type="text" 
                                       id="kembalian_display" 
                                       class="form-control form-control-custom fw-bold" 
                                       value="Rp 0" 
                                       style="background-color: #EFEFEF; color: var(--color-primary);" 
                                       readonly>
                                <input type="hidden" name="kembalian" id="kembalian" value="{{ old('kembalian', $sale->kembalian ?? 0) }}">
                            </div>
                        </div>

                        <div id="qris-payment-section" class="mb-3" style="display: none;">
                            <div class="qris-card-box">
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <span class="fw-bold fs-5 text-danger me-1">QRIS</span>
                                    <span class="badge bg-secondary style-sm" style="font-size: 0.65rem;">NATIONAL QR CODE</span>
                                </div>
                                
                                <p class="small text-muted mb-2">Scan kode QR berikut menggunakan aplikasi Mobile Banking atau e-Wallet (Gopay/OVO/Dana/ShopeePay)</p>
                                
                                <div class="my-3 p-2 bg-white d-inline-block border rounded shadow-sm">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=FAKE_QRIS_PAYMENT_TOTAL_{{ $sale->total_pembayaran ?? 0 }}" 
                                         alt="QRIS Code Pembayaran" 
                                         class="img-fluid" style="width: 170px; height: 170px;">
                                </div>
                                
                                <div class="fw-bold fs-6 mb-2" style="color: var(--color-primary);">
                                    Nominal: Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
                                </div>

                                <div id="qris-status-box" class="alert alert-warning py-2 mb-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-hourglass-split"></i> Menunggu Pemindaian QR...
                                </div>

                                <button type="button" id="btn-simulate-qris" class="btn btn-sm btn-outline-success w-100 fw-bold">
                                    <i class="bi bi-qr-code-scan"></i> Simulasi Pelanggan Sudah Bayar
                                </button>
                            </div>
                        </div>

                        <button type="submit" id="btn-submit-checkout" class="btn btn-checkout-theme w-100 mb-2" {{ ($sale->itemPenjualan->count() == 0 || $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                            Proses Selesai (Checkout)
                        </button>
                    </form>

                    @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan transaksi?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-cancel-theme w-100" {{ ($sale->itemPenjualan->count() == 0 || $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                            Batalkan Sesi Transaksi
                        </button>
                    </form>
                    @endcan
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const totalPembayaran = Number("{{ $sale->total_pembayaran ?? 0 }}");
    const paymentMethodSelect = document.getElementById('payment_method');
    const cashSection = document.getElementById('cash-payment-section');
    const qrisSection = document.getElementById('qris-payment-section');
    const uangDibayarInput = document.getElementById('uang_dibayar');
    const kembalianDisplay = document.getElementById('kembalian_display');
    const kembalianHidden = document.getElementById('kembalian');
    
    const btnSimulateQris = document.getElementById('btn-simulate-qris');
    const qrisStatusBox = document.getElementById('qris-status-box');
    let isQrisPaid = false;

    function calculateChange() {
        let paid = parseFloat(uangDibayarInput.value) || 0;
        let change = paid - totalPembayaran;

        if (change < 0) {
            kembalianDisplay.value = "Rp 0 (Uang Kurang)";
            kembalianDisplay.style.color = "#A54A4A";
            kembalianHidden.value = 0;
        } else {
            kembalianDisplay.value = "Rp " + change.toLocaleString('id-ID');
            kembalianDisplay.style.color = "#493628";
            kembalianHidden.value = change;
        }
    }

    function togglePaymentSection() {
        if (!paymentMethodSelect) return;
        
        const selectedValue = paymentMethodSelect.value;

        cashSection.style.display = 'none';
        qrisSection.style.display = 'none';
        uangDibayarInput.removeAttribute('required');

        if (selectedValue === 'CASH') {
            cashSection.style.display = 'block';
            uangDibayarInput.setAttribute('required', 'required');
            calculateChange();
        } else if (selectedValue === 'QRIS') {
            qrisSection.style.display = 'block';
            uangDibayarInput.value = totalPembayaran;
            kembalianHidden.value = 0;
        } else {
            uangDibayarInput.value = 0;
            kembalianHidden.value = 0;
        }
    }

    if (btnSimulateQris) {
        btnSimulateQris.addEventListener('click', function() {
            isQrisPaid = true;
            qrisStatusBox.className = "alert alert-success py-2 mb-2";
            qrisStatusBox.innerHTML = '<i class="bi bi-check-circle-fill"></i> Pembayaran QRIS Berhasil Diverifikasi!';
            btnSimulateQris.className = "btn btn-sm btn-success w-100 fw-bold disabled";
            btnSimulateQris.innerText = "Pembayaran Terkonfirmasi ✓";
        });
    }

    if (paymentMethodSelect) {
        paymentMethodSelect.addEventListener('change', function() {
            isQrisPaid = false;
            if (qrisStatusBox) {
                qrisStatusBox.className = "alert alert-warning py-2 mb-2";
                qrisStatusBox.innerHTML = '<i class="bi bi-hourglass-split"></i> Menunggu Pemindaian QR...';
            }
            if (btnSimulateQris) {
                btnSimulateQris.className = "btn btn-sm btn-outline-success w-100 fw-bold";
                btnSimulateQris.innerHTML = '<i class="bi bi-qr-code-scan"></i> Simulasi Pelanggan Sudah Bayar';
            }

            togglePaymentSection();
        });

        uangDibayarInput.addEventListener('input', calculateChange);
        
        togglePaymentSection();
    }

    function validatePayment() {
        const selectedValue = paymentMethodSelect.value;

        if (selectedValue === 'CASH') {
            let paid = parseFloat(uangDibayarInput.value) || 0;
            if (paid < totalPembayaran) {
                alert('Nominal uang yang dibayarkan masih kurang!');
                return false;
            }
        } else if (selectedValue === 'QRIS') {
            if (!isQrisPaid) {
                alert('Silakan klik tombol "Simulasi Pelanggan Sudah Bayar" terlebih dahulu untuk mengonfirmasi transaksi QRIS!');
                return false;
            }
        }
        
        return confirm('Yakin ingin melakukan checkout transaksi?');
    }

    let searchTimer;
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (searchInput.value) {
                searchInput.focus();
                searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
            }
        });
    }
</script>

@endsection
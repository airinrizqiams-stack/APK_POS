<!-- memanggil file app.blade.php -->


<!-- mengirimkan nilai ke tittle untuk ditampilkan -->
<?php $__env->startSection('title', 'Login'); ?>

<!-- batas awal isi konten -->
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="text-center">
    <div class="row">
        <div class="col-md-12">
            <h1>Today's Sales</h1>
        </div>
        <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Total Nilai Penjualan Hari ini
        <div>
        <div class="card-body">
           <h5 class="card-title">Rp <?php echo e(number_format($ringkasan['total_penjualan'])); ?></h5>
        </div>
      </div>
    </div>
        <div class="col-md-6">
            <h3>Jumlah Transaksi Hari ini</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Cash & Payment Status</h1>
        </div>
        <div class="col-md-6">
            <h3>Total pembayaran tunai</h3>
        </div>
        <div class="col-md-6">
            <h3>Total pembayaran non-tunai</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Critical Inventory Status</h1>
        </div>
        <div class="col-md-6">
            <h3>Daftar produk stok rendah</h3>
        </div>
        <div class="col-md-6">
            <h3>Produk habis stok</h3>
        </div>
    </div>
</div>

<!-- batas Akhir isi konten -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\POS\resources\views/dashboard.blade.php ENDPATH**/ ?>
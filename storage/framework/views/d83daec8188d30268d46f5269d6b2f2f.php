<!-- memanggil file app.blade.php-->


<!-- mengirimkan nilai ke tittle untuk ditampilkan -->
<?php $__env->startSection('title', 'Ini Halaman Ujicoba'); ?>

<!-- batas awal isi konten -->
<?php $__env->startSection('content'); ?>

<button type="button" class="btn btn-primary">Primary</button>
<button type="button" class="btn btn-secondary">Secondary</button>
<button type="button" class="btn btn-success">Success</button>
<button type="button" class="btn btn-danger">Danger</button>
<button type="button" class="btn btn-warning">Warning</button>
<button type="button" class="btn btn-info">Info</button>
<button type="button" class="btn btn-light">Light</button>
<button type="button" class="btn btn-dark">Dark</button>

<button type="button" class="btn btn-link">Link</button>

<!-- batas Akhir isi konten -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\POS\resources\views/welcome.blade.php ENDPATH**/ ?>
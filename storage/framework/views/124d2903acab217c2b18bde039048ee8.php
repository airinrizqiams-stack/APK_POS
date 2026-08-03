<!-- memanggil file app.blade.php-->


<!-- mengirimkan nilai ke tittle untuk ditampilkan -->
<?php $__env->startSection('title', 'Login'); ?>

<!-- batas awal isi konten -->
<?php $__env->startSection('content'); ?>

<!-- 2. Kotak Login Form -->
<div class="card text-center position-absolute top-50 start-50 translate-middle" style="width: 18rem;">
  <h5 class="card-header">Login POS</h5>
  <div class="card-body">
    <form action="<?php echo e(route('auth')); ?>" method="POST">
      <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control"
            id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="badge text-bg-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control"
            id="exampleInputPassword1">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="badge text-bg-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<!-- batas Akhir isi konten -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\POS\resources\views/login.blade.php ENDPATH**/ ?>
<!-- resources/views/welcome.blade.php -->



<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Passguard')); ?></div>

                    <div class="card-body text-center">
                        <h1>Welcome to Passguard</h1>
                        <?php if(auth()->guard()->guest()): ?>
                            <p class="mb-4">Please log in or register to continue.</p>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary mx-2">Login</a>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-secondary mx-2">Register</a>
                        <?php else: ?>
                            <p class="mb-4">You are logged in!</p>
                            <a href="<?php echo e(route('vault.index')); ?>" class="btn btn-primary mx-2">Go to Vault</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\larapass\resources\views/welcome.blade.php ENDPATH**/ ?>
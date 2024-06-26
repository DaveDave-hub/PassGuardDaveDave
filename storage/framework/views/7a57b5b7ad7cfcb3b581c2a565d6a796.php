<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Vault')); ?></div>

                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <!-- Search Form -->
                        <form method="GET" action="<?php echo e(route('vault.search')); ?>">
                            <div class="form-group row">
                                <label for="query" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Search')); ?></label>
                                <div class="col-md-6">
                                    <input id="query" type="text" class="form-control" name="query" value="<?php echo e(request('query')); ?>" autocomplete="query" autofocus>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary"><?php echo e(__('Search')); ?></button>
                                </div>
                            </div>
                        </form>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Platform</th>
                                <th>Email/Username</th>
                                <th>Password</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $passwords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $password): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($password->platform); ?></td>
                                    <td><?php echo e($password->email_username); ?></td>
                                    <td><?php echo e($password->password); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('vault.edit', $password->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="<?php echo e(route('vault.destroy', $password->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center">
                            <?php echo e($passwords->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\larapass\resources\views/vault/index.blade.php ENDPATH**/ ?>
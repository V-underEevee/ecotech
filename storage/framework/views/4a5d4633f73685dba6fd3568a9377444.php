

<?php $__env->startSection('title', 'Servicios'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1>Nuestros Servicios</h1>
            <p class="lead">Planes sustentables para vos y tu hogar</p>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle"></i> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100">
                <img src="<?php echo e($service->image); ?>" class="card-img-top" alt="<?php echo e($service->name); ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge bg-success mb-2"><?php echo e($service->category); ?></span>
                    <span class="badge bg-info mb-2"><?php echo e($service->eco_feature); ?></span>
                    <h4 class="card-title mt-2"><?php echo e($service->name); ?></h4>
                    <p class="card-text text-muted"><?php echo e(Str::limit($service->description, 80)); ?></p>
                    <h5 class="text-success">$<?php echo e(number_format($service->price, 2)); ?></h5>
                    <?php if(auth()->guard()->check()): ?>
                        <form action="<?php echo e(route('services.subscribe')); ?>" method="POST" class="mt-3">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="service_id" value="<?php echo e($service->id); ?>">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-check-circle"></i> Contratar
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-success w-100 mt-3">
                            <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<style>
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.card-img-top {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/services/index.blade.php ENDPATH**/ ?>
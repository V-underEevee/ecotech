

<?php $__env->startSection('title', 'Productos Ecológicos'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1>Nuestros Productos Ecológicos</h1>
            <p class="lead">Tecnología sustentable para cuidar el planeta</p>
        </div>
    </div>

    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4">
            <a href="/products/<?php echo e($product->slug); ?>" class="text-decoration-none">
                <div class="card product-card h-100">
                    <img src="<?php echo e($product->image); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-success mb-2"><?php echo e($product->category); ?></span>
                        <span class="badge bg-info mb-2"><?php echo e($product->eco_feature); ?></span>
                        <h4 class="card-title mt-2 text-dark"><?php echo e($product->name); ?></h4>
                        <p class="card-text text-muted"><?php echo e(Str::limit($product->description, 80)); ?></p>
                        <h5 class="text-success"><?php echo e($product->formatted_price); ?></h5>
                        <p class="text-muted small">Stock: <?php echo e($product->stock); ?> unidades</p>
                    </div>
                </div>
            </a>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech2\resources\views/products/index.blade.php ENDPATH**/ ?>
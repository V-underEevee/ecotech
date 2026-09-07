

<?php $__env->startSection('title', 'Tecnología Sustentable'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Tecnología que cuida el planeta</h1>
                <p class="lead mb-4">Descubre nuestra selección de productos eco-friendly diseñados para reducir tu huella de carbono sin sacrificar rendimiento.</p>
                <a href="/productos" class="btn btn-light btn-lg">Ver productos</a>
            </div>
        </div>
    </div>
</div>

<!-- Beneficios -->
<div class="container py-5">
    <div class="row text-center mb-5">
        <div class="col-12">
            <h2>¿Por qué elegir EcoTech?</h2>
            <p class="lead">Innovación sustentable para un futuro mejor</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="text-center">
                <i class="bi bi-recycle" style="font-size: 48px; color: #2d6a4f;"></i>
                <h4 class="mt-3">Materiales Reciclados</h4>
                <p>Productos fabricados con materiales 100% reciclados o biodegradables</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <i class="bi bi-battery-charging" style="font-size: 48px; color: #2d6a4f;"></i>
                <h4 class="mt-3">Eficiencia Energética</h4>
                <p>Tecnología de bajo consumo que reduce tu factura de luz</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <i class="bi bi-tree" style="font-size: 48px; color: #2d6a4f;"></i>
                <h4 class="mt-3">Carbono Neutral</h4>
                <p>Compensamos el 100% de nuestra huella de carbono</p>
            </div>
        </div>
    </div>
</div>

<!-- Productos destacados -->
<div class="container py-5 bg-light">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2>Productos Destacados</h2>
            <p>Lo mejor de nuestra colección eco-friendly</p>
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card product-card h-100">
                <img src="<?php echo e($product->image); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge bg-success mb-2"><?php echo e($product->category); ?></span>
                    <h5 class="card-title"><?php echo e($product->name); ?></h5>
                    <p class="card-text small"><?php echo e(Str::limit($product->description, 80)); ?></p>
                    <h6 class="text-success"><?php echo e($product->formatted_price); ?></h6>
                    <a href="/products/<?php echo e($product->slug); ?>" class="btn btn-sm btn-outline-success w-100">Ver más</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="text-center mt-4">
        <a href="/products" class="btn btn-success">Ver todos los productos</a>
    </div>
</div>

<!-- Últimas novedades del blog -->
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2>Últimas Novedades</h2>
            <p>Artículos sobre tecnología sustentable</p>
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4">
            <div class="card post-card h-100">
                <?php if($post->image): ?>
                    <img src="<?php echo e($post->image); ?>" class="card-img-top" alt="<?php echo e($post->title); ?>" style="height: 200px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body">
                    <small class="text-muted"><?php echo e($post->published_date->format('d/m/Y')); ?> | <?php echo e($post->author); ?></small>
                    <h5 class="card-title mt-2"><?php echo e($post->title); ?></h5>
                    <p class="card-text small"><?php echo e(Str::limit($post->excerpt, 100)); ?></p>
                    <a href="/blog/<?php echo e($post->slug); ?>" class="btn btn-sm btn-outline-success">Leer más</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="text-center mt-4">
        <a href="/blog" class="btn btn-success">Ver todas las novedades</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/home.blade.php ENDPATH**/ ?>
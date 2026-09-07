

<?php $__env->startSection('title', $post->title); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="<?php echo e(route('blog.index')); ?>" class="btn btn-outline-success">
                    <i class="bi bi-arrow-left"></i> Volver al blog
                </a>
            </div>
            <div class="card">
                <!-- Imagen destacada -->
                <?php if($post->image): ?>
                    <?php
                        // IDs de los posts con imagen vertical
                        $verticalPosts = [2, 4];
                        $position = in_array($post->id, $verticalPosts) ? 'top' : 'center';
                    ?>
                    <img src="<?php echo e(asset($post->image)); ?>" class="card-img-top" alt="<?php echo e($post->title); ?>" 
                         style="width: 100%; max-height: 400px; object-fit: cover; object-position: <?php echo e($position); ?>; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <?php endif; ?>
                <div class="card-body">
                    <div class="text-muted mb-3">
                        <i class="bi bi-calendar"></i> <?php echo e($post->published_date->format('d/m/Y')); ?> |
                        <i class="bi bi-person"></i> <?php echo e($post->author); ?> |
                        <i class="bi bi-eye"></i> <?php echo e($post->views); ?> vistas
                    </div>
                    <h1 class="card-title mb-4"><?php echo e($post->title); ?></h1>
                    <div class="card-text">
                        <?php echo $post->content; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/blog/show.blade.php ENDPATH**/ ?>
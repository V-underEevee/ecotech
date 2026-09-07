

<?php $__env->startSection('title', 'Blog de Novedades'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1>Blog de Novedades</h1>
            <p class="lead">Consejos y noticias sobre tecnologia sustentable</p>
        </div>
    </div>

    <?php if($posts->count() > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card post-card h-100">
                    <?php if($post->image): ?>
                        <?php
                            // IDs de los posts con imagen vertical
                            $verticalPosts = [2, 4]; 
                            $position = in_array($post->id, $verticalPosts) ? 'top' : 'center';
                        ?>
                        <img src="<?php echo e(asset($post->image)); ?>" class="card-img-top" alt="<?php echo e($post->title); ?>" 
                             style="height: 200px; object-fit: cover; object-position: <?php echo e($position); ?>; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <?php endif; ?>
                    <div class="card-body">
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> <?php echo e(\Carbon\Carbon::parse($post->published_date)->format('d/m/Y')); ?> |
                            <i class="bi bi-person"></i> <?php echo e($post->author); ?>

                        </small>
                        <h4 class="card-title mt-2"><?php echo e($post->title); ?></h4>
                        <p class="card-text"><?php echo e(Str::limit($post->excerpt, 100)); ?></p>
                        <a href="/blog/<?php echo e($post->slug); ?>" class="btn btn-outline-success">Leer mas</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Paginacion -->
        <div class="row mt-4">
            <div class="col-12">
                <?php echo e($posts->links()); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <h4>No hay articulos disponibles</h4>
            <p>Pronto agregaremos contenido nuevo.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/blog/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-3">Panel de Control</h4>
        <p class="text-muted">Estadisticas generales del sistema</p>
    </div>
</div>

<!-- Tarjetas de estadisticas -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-people"></i> Usuarios</h5>
                <h2 class="mb-0"><?php echo e($totalUsers); ?></h2>
                <small>Registrados en el sistema</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-box-seam"></i> Servicios</h5>
                <h2 class="mb-0"><?php echo e($totalServices); ?></h2>
                <small>Contratados en total</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-newspaper"></i> Posts</h5>
                <h2 class="mb-0"><?php echo e($totalPosts); ?></h2>
                <small>Publicados en el blog</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-box"></i> Productos</h5>
                <h2 class="mb-0"><?php echo e($totalProducts); ?></h2>
                <small>En el catalogo</small>
            </div>
        </div>
    </div>
</div>

<!-- Estadisticas detalladas -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-trophy"></i> Servicio mas contratado</h5>
            </div>
            <div class="card-body">
                <?php if($mostPopularService): ?>
                    <h3><?php echo e($mostPopularService->service_name); ?></h3>
                    <p class="text-muted"><?php echo e($mostPopularService->total); ?> contrataciones</p>
                <?php else: ?>
                    <p class="text-muted">No hay servicios contratados aun</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-star"></i> Usuario con mas servicios</h5>
            </div>
            <div class="card-body">
                <?php if($topUser && $topUser->services_count > 0): ?>
                    <h3><?php echo e($topUser->name); ?></h3>
                    <p class="text-muted"><?php echo e($topUser->services_count); ?> servicios contratados</p>
                <?php else: ?>
                    <p class="text-muted">No hay usuarios con servicios</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Servicios por estado -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Estado de servicios</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="p-3 bg-success bg-opacity-10 rounded">
                            <h3 class="text-success"><?php echo e($activeServices); ?></h3>
                            <small>Activos</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-danger bg-opacity-10 rounded">
                            <h3 class="text-danger"><?php echo e($cancelledServices); ?></h3>
                            <small>Cancelados</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Ultimos servicios</h5>
            </div>
            <div class="card-body">
                <?php if($recentServices->count() > 0): ?>
                    <ul class="list-group list-group-flush">
                        <?php $__currentLoopData = $recentServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?php echo e($service->service_name); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo e($service->user->name ?? 'Usuario'); ?></small>
                                </div>
                                <span class="badge <?php echo e($service->status === 'activo' ? 'bg-success' : 'bg-danger'); ?>">
                                    <?php echo e($service->status); ?>

                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">No hay servicios recientes</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
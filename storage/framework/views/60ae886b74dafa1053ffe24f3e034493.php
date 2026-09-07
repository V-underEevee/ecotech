

<?php $__env->startSection('title', 'Detalles del Usuario'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0"><?php echo e($user->name); ?></h4>
        <p class="text-muted">Detalles del usuario y sus servicios contratados</p>
    </div>
    <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Informacion del Usuario</h5>
                <table class="table table-sm">
                    <tr>
                        <th>ID</th>
                        <td><?php echo e($user->id); ?></td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td><?php echo e($user->name); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo e($user->email); ?></td>
                    </tr>
                    <tr>
                        <th>Rol</th>
                        <td>
                            <span class="badge <?php echo e($user->role === 'admin' ? 'bg-danger' : 'bg-primary'); ?>">
                                <?php echo e($user->role); ?>

                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Registro</th>
                        <td><?php echo e($user->created_at->format('d/m/Y H:i')); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Servicios Contratados</h5>
            </div>
            <div class="card-body">
                <?php if($user->services->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Servicio</th>
                                    <th>Precio</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $user->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($service->service_name); ?></td>
                                    <td>$<?php echo e(number_format($service->price, 2)); ?></td>
                                    <td><?php echo e($service->contract_date->format('d/m/Y')); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($service->status === 'activo' ? 'bg-success' : 'bg-danger'); ?>">
                                            <?php echo e($service->status); ?>

                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <strong>Total:</strong> <?php echo e($user->services->count()); ?> servicios
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center">Este usuario no tiene servicios contratados.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/admin/users/show.blade.php ENDPATH**/ ?>
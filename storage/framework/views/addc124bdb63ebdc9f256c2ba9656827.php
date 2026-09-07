

<?php $__env->startSection('title', 'Listado de Usuarios'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0">Listado de Usuarios</h4>
        <p class="text-muted">Todos los usuarios registrados en el sistema</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Servicios</th>
                        <th>Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($user->id); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <span class="badge <?php echo e($user->role === 'admin' ? 'bg-danger' : 'bg-primary'); ?>">
                                <?php echo e($user->role); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-success"><?php echo e($user->services->count()); ?></span>
                        </td>
                        <td><?php echo e($user->created_at->format('d/m/Y')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.users.show', $user)); ?>" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay usuarios registrados</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/admin/users/index.blade.php ENDPATH**/ ?>
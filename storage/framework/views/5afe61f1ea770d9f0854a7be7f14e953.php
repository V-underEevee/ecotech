

<?php $__env->startSection('title', 'Mis Pedidos'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1>Mis Pedidos</h1>
                <p class="lead">Seguimiento de tus compras</p>
            </div>
            <?php if(count($orders) > 0): ?>
            <div>
                <button class="btn btn-outline-danger" onclick="confirmDeleteAll()">
                    <i class="bi bi-trash3"></i> Eliminar todos
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if(count($orders) > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <strong>Pedido #<?php echo e($order->id); ?></strong>
                        <div>
                            <span class="badge bg-light text-dark me-2"><?php echo e(ucfirst($order->status)); ?></span>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?php echo e($order->id); ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            <strong>Fecha:</strong> <?php echo e($order->created_at->format('d/m/Y H:i')); ?>

                        </p>
                        <p class="mb-2">
                            <strong>Total:</strong> <span class="text-success fs-5">$<?php echo e(number_format($order->total, 2)); ?></span>
                        </p>
                        <?php if($order->discount > 0): ?>
                        <p class="mb-2 text-danger">
                            <strong>Descuento aplicado:</strong> -$<?php echo e(number_format($order->discount, 2)); ?>

                        </p>
                        <?php endif; ?>
                        <p class="mb-2">
                            <strong>Método de pago:</strong> <?php echo e(ucfirst($order->payment_method)); ?>

                        </p>
                        <p class="mb-3">
                            <strong>Productos:</strong> <?php echo e($order->items->sum('quantity')); ?> unidades
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-success btn-sm" onclick="showTracking(<?php echo e($order->id); ?>)">
                                <i class="bi bi-truck"></i> Ver seguimiento
                            </button>
                            <button class="btn btn-success btn-sm" onclick="showOrderDetails(<?php echo e($order->id); ?>)">
                                <i class="bi bi-eye"></i> Ver detalles
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-box-seam" style="font-size: 80px; color: #ccc;"></i>
            <h3 class="mt-3">No tenés pedidos aún</h3>
            <p>¡Realizá tu primera compra!</p>
            <a href="/productos" class="btn btn-success">Ver productos</a>
        </div>
    <?php endif; ?>
</div>

<!-- Modal de seguimiento -->
<div class="modal fade" id="trackingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Seguimiento de envío</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-5">
                <i class="bi bi-clock-history" style="font-size: 64px; color: #2d6a4f;"></i>
                <h4 class="mt-3">Próximamente...</h4>
                <p class="text-muted">Estamos trabajando en el sistema de seguimiento</p>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Seguimos trabajando
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de detalles del pedido -->
<div class="modal fade" id="detailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Detalles del pedido</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailsModalBody">
                <div class="text-center">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar uno -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este pedido?</p>
                <p class="text-muted small">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar todos -->
<div class="modal fade" id="deleteAllModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar TODOS tus pedidos?</p>
                <p class="text-muted small">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteAllForm" method="POST" action="<?php echo e(route('orders.destroyAll')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Eliminar todos</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function showTracking(orderId) {
    var myModal = new bootstrap.Modal(document.getElementById('trackingModal'));
    myModal.show();
}

function showOrderDetails(orderId) {
    fetch(`/pedidos/${orderId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('detailsModalBody').innerHTML = html;
            var myModal = new bootstrap.Modal(document.getElementById('detailsModal'));
            myModal.show();
        });
}

function confirmDelete(orderId) {
    let form = document.getElementById('deleteForm');
    form.action = `/pedidos/${orderId}`;
    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    myModal.show();
}

function confirmDeleteAll() {
    var myModal = new bootstrap.Modal(document.getElementById('deleteAllModal'));
    myModal.show();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/orders/index.blade.php ENDPATH**/ ?>
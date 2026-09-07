<div class="container-fluid">
    <h6 class="mb-3">Productos del pedido #<?php echo e($order->id); ?></h6>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product->name); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                    <td>$<?php echo e(number_format($item->price * $item->quantity, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot class="table-light">
                <?php if($order->discount > 0): ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                    <td>$<?php echo e(number_format($order->subtotal, 2)); ?></td>
                </tr>
                <tr class="text-danger">
                    <td colspan="3" class="text-end"><strong>Descuento 10%:</strong></td>
                    <td>-$<?php echo e(number_format($order->discount, 2)); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td><strong class="text-success">$<?php echo e(number_format($order->total, 2)); ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="mt-3">
        <small class="text-muted">
            Pedido realizado: <?php echo e($order->created_at->format('d/m/Y H:i')); ?><br>
            Método de pago: <?php echo e(ucfirst($order->payment_method)); ?><br>
            Estado: <span class="badge bg-success"><?php echo e(ucfirst($order->status)); ?></span>
        </small>
    </div>
</div><?php /**PATH C:\laragon\www\ecotech\resources\views/orders/show.blade.php ENDPATH**/ ?>
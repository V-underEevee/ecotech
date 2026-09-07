

<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <a href="/products" class="btn btn-outline-success">
                <i class="bi bi-arrow-left"></i> Volver a productos
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="<?php echo e($product->image); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 400px; object-fit: cover;">
            </div>
        </div>
        <div class="col-md-6">
            <span class="badge bg-success mb-2"><?php echo e($product->category); ?></span>
            <span class="badge bg-info mb-2"><?php echo e($product->eco_feature); ?></span>
            <h1><?php echo e($product->name); ?></h1>
            <p class="lead"><?php echo e($product->description); ?></p>
            <h2 class="text-success"><?php echo e($product->formatted_price); ?></h2>
            <p class="text-muted">Stock disponible: <strong><?php echo e($product->stock); ?> unidades</strong></p>
            
           <!-- Selector de cantidad y botón agregar al carrito (FORMULARIO NORMAL) -->
<div class="mt-4">
    <label class="form-label">Cantidad</label>
    <div class="row align-items-center g-2">
        <div class="col-4">
            <div class="input-group">
                <button type="button" class="btn btn-outline-secondary" onclick="decrementQuantity()">-</button>
                <input type="number" id="quantity" value="1" min="1" max="<?php echo e($product->stock); ?>" class="form-control text-center" style="max-width: 70px;">
                <button type="button" class="btn btn-outline-secondary" onclick="incrementQuantity()">+</button>
            </div>
        </div>
        <div class="col-8">
            <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="quantity" id="quantity-hidden" value="1">
                <button type="submit" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-cart-plus"></i> Agregar al carrito
                </button>
            </form>
        </div>
    </div>
</div>
    
    <!-- Descripción detallada -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Características destacadas</h3>
            <hr>
            <div class="row">
                <div class="col-md-4">
    <div class="text-center p-3 border rounded h-100">
        <i class="bi bi-plant fs-1 text-success"></i>
        <h5 class="mt-2">Eco-friendly</h5>
        <p class="small"><?php echo e($product->eco_feature); ?></p>
    </div>
</div>
                <div class="col-md-4">
                    <div class="text-center p-3 border rounded h-100">
                        <i class="bi bi-truck fs-1 text-success"></i>
                        <h5 class="mt-2">Envío gratis</h5>
                        <p class="small">Envío gratis a todo el país en compras superiores a $30.000</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3 border rounded h-100">
                        <i class="bi bi-arrow-repeat fs-1 text-success"></i>
                        <h5 class="mt-2">Garantía extendida</h5>
                        <p class="small">12 meses de garantía en todos nuestros productos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Especificaciones técnicas -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Especificaciones técnicas</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2"><strong>🔋 Consumo energético:</strong> Bajo / Clase A++</li>
                        <li class="mb-2"><strong>♻️ Materiales:</strong> <?php echo e($product->eco_feature); ?></li>
                        <li class="mb-2"><strong>📦 Presentación:</strong> Empaque 100% reciclable y libre de plásticos</li>
                        <li class="mb-2"><strong>🏭 Certificaciones:</strong> Energy Star, EPEAT, RoHS</li>
                        <li class="mb-2"><strong>🌍 Huella de carbono:</strong> Neutral (compensamos el 100%)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function incrementQuantity() {
    let input = document.getElementById('quantity');
    let hiddenInput = document.getElementById('quantity-hidden');
    let max = <?php echo e($product->stock); ?>;
    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
        if (hiddenInput) {
            hiddenInput.value = input.value;
        }
    }
}

function decrementQuantity() {
    let input = document.getElementById('quantity');
    let hiddenInput = document.getElementById('quantity-hidden');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        if (hiddenInput) {
            hiddenInput.value = input.value;
        }
    }
}

// Sincronizar la cantidad con el input oculto del formulario
document.addEventListener('DOMContentLoaded', function() {
    let input = document.getElementById('quantity');
    let hiddenInput = document.getElementById('quantity-hidden');
    if (input && hiddenInput) {
        input.addEventListener('change', function() {
            hiddenInput.value = this.value;
        });
        input.addEventListener('input', function() {
            hiddenInput.value = this.value;
        });
    }
});

function addToCart(productId) {
    let quantity = document.getElementById('quantity').value;
    
    fetch('/carrito/agregar/' + productId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification('✅ ' + data.message, 'success');
            // Actualizar contador del carrito en el navbar
            let badge = document.querySelector('.cart-badge');
            if (badge && data.cartCount) {
                badge.textContent = data.cartCount;
                badge.style.display = 'inline-block';
            }
            // Redirigir al carrito después de 1.5 segundos
            setTimeout(() => {
                window.location.href = '/carrito';
            }, 1500);
        } else {
            showNotification('❌ ' + data.message, 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('❌ Error de conexión: ' + error.message, 'danger');
    });
}

function showNotification(message, type = 'success') {
    // Eliminar notificaciones anteriores
    let oldNotifications = document.querySelectorAll('.custom-notification');
    oldNotifications.forEach(el => el.remove());
    
    let notification = document.createElement('div');
    notification.className = `alert alert-${type} position-fixed top-0 end-0 m-3 shadow-lg custom-notification`;
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    notification.style.animation = 'slideInRight 0.5s ease';
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'} me-2 fs-4"></i>
            <span>${message}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Agregar estilos de animación si no existen
if (!document.getElementById('cart-styles')) {
    let style = document.createElement('style');
    style.id = 'cart-styles';
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .cart-badge {
            display: none;
        }
    `;
    document.head.appendChild(style);
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ecotech\resources\views/products/show.blade.php ENDPATH**/ ?>
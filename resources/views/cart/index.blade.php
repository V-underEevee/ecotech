@extends('layouts.app')

@section('title', 'Mi Carrito')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Mi Carrito</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(count($cartItems) > 0)
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Productos</h5>
                        @foreach($cartItems as $item)
                        <div class="row mb-3 pb-3 border-bottom align-items-center">
                            <div class="col-2">
                                <img src="{{ $item->product->image_url }}" class="img-fluid rounded" style="height: 60px; object-fit: cover;">
                            </div>
                            <div class="col-4">
                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">{{ $item->product->formatted_price }}</small>
                            </div>
                            <div class="col-3">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 70px;" onchange="this.form.submit()">
                                </form>
                            </div>
                            <div class="col-2">
                                <strong>${{ number_format($item->product->price * $item->quantity, 2) }}</strong>
                            </div>
                            <div class="col-1">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Resumen</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong>${{ number_format($total, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2" id="discountRow" style="display: none;">
                            <span>Descuento 10% (Transferencia):</span>
                            <strong class="text-danger">-$<span id="discountAmount">0</span></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Envío:</span>
                            <strong class="text-success">Gratis</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fs-5">Total:</span>
                            <strong class="text-success fs-4">$<span id="totalWithDiscount">{{ number_format($total, 2) }}</span></strong>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjetas de medios de pago -->
                <div class="card mt-4 payment-methods">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Medios de pago</h5>
                        <div class="row g-3">
                            <!-- Tarjeta de Crédito -->
                            <div class="col-12">
                                <div class="payment-card" onclick="selectPayment('credit')">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <i class="bi bi-credit-card-2-front fs-1 text-success"></i>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="mb-0">Tarjeta de Crédito</h6>
                                            <small class="text-muted">Visa, Mastercard, American Express</small>
                                        </div>
                                        <div class="col-3 text-end">
                                            <i class="bi bi-check-circle-fill text-success fs-4 payment-check" style="display: none;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Mercado Pago -->
                            <div class="col-12">
                                <div class="payment-card" onclick="selectPayment('mercadopago_checkout')">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjKBF2eoHlu8DAZUE1-9a4NDH4J8o91Bss2Q&s" alt="Mercado Pago" style="height: 40px;">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="mb-0">Mercado Pago</h6>
                                            <small class="text-muted">Pago rápido y seguro con Mercado Pago</small>
                                        </div>
                                        <div class="col-3 text-end">
                                            <i class="bi bi-check-circle-fill text-success fs-4 payment-check" style="display: none;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Transferencia Bancaria -->
                            <div class="col-12">
                                <div class="payment-card" onclick="selectPayment('transfer')">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <i class="bi bi-bank2 fs-1 text-success"></i>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="mb-0">Transferencia Bancaria</h6>
                                            <small class="text-muted">10% de descuento</small>
                                        </div>
                                        <div class="col-3 text-end">
                                            <i class="bi bi-check-circle-fill text-success fs-4 payment-check" style="display: none;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botón de compra -->
                        <button class="btn btn-success w-100 mt-4" onclick="processPurchase()" id="buyButton" disabled>
    <i class="bi bi-lock"></i> Comprar ahora
</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 80px; color: #ccc;"></i>
            <h3 class="mt-3">Tu carrito está vacío</h3>
            <p>¡Explora nuestros productos y agregá los que más te gusten!</p>
            <a href="/products" class="btn btn-success">Ver productos</a>
        </div>
    @endif
</div>

<style>
.payment-card {
    border: 2px solid #e0e0e0;
    border-radius: 15px;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-card:hover {
    border-color: #2d6a4f;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.payment-card.selected {
    border-color: #2d6a4f;
    background-color: #f0fdf4;
}

.payment-check {
    display: none;
}

.payment-card.selected .payment-check {
    display: inline-block;
}
</style>

<script>
let selectedPayment = null;
let originalTotal = {{ $total }};

function selectPayment(method) {
    selectedPayment = method;
    
    // Remover selección de todas
    document.querySelectorAll('.payment-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Agregar selección a la elegida
    event.currentTarget.classList.add('selected');
    
    // Calcular descuento
    let discountRow = document.getElementById('discountRow');
    let discountAmount = document.getElementById('discountAmount');
    let totalSpan = document.getElementById('totalWithDiscount');
    
    if (method === 'transfer') {
        // 10% de descuento
        let discount = originalTotal * 0.10;
        let newTotal = originalTotal - discount;
        discountAmount.textContent = discount.toFixed(2);
        discountRow.style.display = 'flex';
        totalSpan.textContent = newTotal.toFixed(2);
    } else {
        discountRow.style.display = 'none';
        totalSpan.textContent = originalTotal.toFixed(2);
    }
    
    // Habilitar botón de compra
    document.getElementById('buyButton').disabled = false;
}

function processPurchase() {
    if (!selectedPayment) {
        showNotification('⚠️ Por favor seleccioná un método de pago', 'warning');
        return;
    }
    
    let totalAPagar = parseFloat(document.getElementById('totalWithDiscount').textContent);
    
    if (selectedPayment === 'mercadopago_checkout') {
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/checkout';
        form.innerHTML = `
            @csrf
            <input type="hidden" name="payment_method" value="mercadopago_checkout">
            <input type="hidden" name="total" value="${totalAPagar}">
        `;
        document.body.appendChild(form);
        form.submit();
        return;
    }
    
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = '/checkout';
    form.innerHTML = `
        @csrf
        <input type="hidden" name="payment_method" value="${selectedPayment}">
        <input type="hidden" name="total" value="${totalAPagar}">
    `;
    document.body.appendChild(form);
    form.submit();
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
    notification.style.zIndex = '9999';
    notification.innerHTML = message;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}
</script>
@endsection
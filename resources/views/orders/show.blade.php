<div class="container-fluid">
    <h6 class="mb-3">Productos del pedido #{{ $order->id }}</h6>
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
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                @if($order->discount > 0)
                <tr>
                    <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                    <td>${{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr class="text-danger">
                    <td colspan="3" class="text-end"><strong>Descuento 10%:</strong></td>
                    <td>-${{ number_format($order->discount, 2) }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td><strong class="text-success">${{ number_format($order->total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="mt-3">
        <small class="text-muted">
            Pedido realizado: {{ $order->created_at->format('d/m/Y H:i') }}<br>
            Método de pago: {{ ucfirst($order->payment_method) }}<br>
            Estado: <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
        </small>
    </div>
</div>
@extends('layouts.app')

@section('title', '¡Compra Exitosa!')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-lg border-0">
                <div class="card-body py-5">
                    <i class="bi bi-star-fill fs-1 text-warning"></i>
                    <i class="bi bi-star-fill fs-2 text-warning"></i>
                    <i class="bi bi-star-fill fs-1 text-warning"></i>
                    <h1 class="display-4 text-success mt-3">¡Compra Exitosa! 🌠</h1>
                    <p class="lead mt-3">Tu pedido ha sido confirmado</p>
                    <p class="text-muted">Gracias por elegir productos sustentables</p>
                    
                    <hr class="my-4">
                    
                    <h5 class="mb-3">¿Deseas ver el trayecto de tu pedido?</h5>
                    <button class="btn btn-success btn-lg" onclick="showTracking()">
                        <i class="bi bi-truck"></i> Ver Envío
                    </button>
                </div>
            </div>
        </div>
    </div>
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

<script>
function showTracking() {
    var myModal = new bootstrap.Modal(document.getElementById('trackingModal'));
    myModal.show();
}
</script>
@endsection
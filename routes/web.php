<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

// ============================================
// RUTAS PRINCIPALES (HOME)
// ============================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ============================================
// RUTAS DEL BLOG PÚBLICO
// ============================================
Route::get('/blog', function() {
    return '✅ Blog route is working!';
});
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
// Rutas de servicios/planes
Route::get('/servicios', [ServiceController::class, 'index'])->name('services.index');
Route::post('/servicios/subscribe', [ServiceController::class, 'subscribe'])->name('services.subscribe');
Route::post('/servicios/cancel/{id}', [ServiceController::class, 'cancel'])->name('services.cancel');

// ============================================
// RUTAS DE PRODUCTOS (si existen)
// ============================================
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// ============================================
// RUTAS DE AUTENTICACIÓN Y DASHBOARD
// ============================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// ============================================
// PANEL DE ADMIN
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('blog', AdminBlogController::class)->names('admin.blog');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
});

// ============================================
// CARRITO
// ============================================
Route::middleware('auth')->group(function () {

    Route::get('/carrito', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/carrito/agregar/{productId}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::put('/carrito/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/carrito/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::delete('/carrito', [CartController::class, 'clear'])
        ->name('cart.clear');

    Route::post('/checkout', [CartController::class, 'checkout'])
        ->name('cart.checkout');


    Route::get('/pedidos', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/pedidos/{order}', [OrderController::class, 'show']);

    Route::delete('/pedidos/{order}', [OrderController::class, 'destroy']);

    Route::delete('/pedidos', [OrderController::class, 'destroyAll'])
        ->name('orders.destroyAll');

});

// ============================================
// RUTAS DE PAGO (MercadoPago)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/pagar/{orderId}', [PaymentController::class, 'createPreference'])->name('payment.create');
});

Route::get('/pago-exitoso', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/pago-fallido', [PaymentController::class, 'failure'])->name('payment.failure');
Route::get('/pago-pendiente', [PaymentController::class, 'pending'])->name('payment.pending');

Route::post('/webhook/mp', [PaymentController::class, 'webhook'])->name('payment.webhook');


require __DIR__.'/auth.php';
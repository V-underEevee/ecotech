<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
{
    $sessionId = Session::getId();
    $cartItems = Cart::with('product')
        ->where('session_id', $sessionId)
        ->get();
        
    $total = $cartItems->sum(function($item) {
        return $item->product->price * $item->quantity;
    });
    
    // Buscar pedido pendiente para el orderId
    $orderId = 0;
    $order = Order::where('session_id', $sessionId)
        ->where('status', 'pendiente')
        ->first();
    if ($order) {
        $orderId = $order->id;
    }
    
    return view('cart.index', compact('cartItems', 'total', 'orderId'));
}
    
    public function add(Request $request, $productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $sessionId = Session::getId();
            $quantity = $request->input('quantity', 1);
            
            if ($quantity < 1) {
                $quantity = 1;
            }
            
            $cartItem = Cart::where('session_id', $sessionId)
                ->where('product_id', $productId)
                ->first();
                
            if ($cartItem) {
                $cartItem->quantity = $cartItem->quantity + $quantity;
                $cartItem->save();
            } else {
                $cart = new Cart();
                $cart->session_id = $sessionId;
                $cart->product_id = $productId;
                $cart->quantity = $quantity;
                $cart->save();
            }
            
            $cartCount = Cart::where('session_id', $sessionId)->sum('quantity');
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Producto agregado al carrito',
                    'cartCount' => $cartCount,
                    'cartUrl' => route('cart.index')
                ]);
            }
            
            return redirect()->route('cart.index')
                ->with('success', 'Producto agregado al carrito');
            
        } catch (\Exception $e) {
            Log::error('Error al agregar al carrito: ' . $e->getMessage());
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Error: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                ->with('error', 'Error al agregar producto: ' . $e->getMessage());
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $cartItem = Cart::findOrFail($id);
            
            $quantity = $request->quantity;
            if ($quantity < 1) {
                $quantity = 1;
            }
            
            $cartItem->update(['quantity' => $quantity]);
            
            return redirect()->back()
                ->with('success', 'Carrito actualizado');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el carrito');
        }
    }
    
    public function remove($id)
    {
        try {
            $cartItem = Cart::findOrFail($id);
            $cartItem->delete();
            
            return redirect()->back()
                ->with('success', 'Producto eliminado del carrito');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el producto');
        }
    }
    
    public function clear(Request $request)
    {
        try {
            $sessionId = Session::getId();
            Cart::where('session_id', $sessionId)->delete();
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true]);
            }
            
            return redirect()->route('cart.index')
                ->with('success', 'Carrito vaciado');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al vaciar el carrito');
        }
    }
    
    public function checkout(Request $request)
    {
        //dd($request->all());
        try {
            $sessionId = Session::getId();
            $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();
            
            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')
                    ->with('error', 'Carrito vacío');
            }
            
            $subtotal = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
            
            $paymentMethod = $request->payment_method ?? 'credito';
            $discount = ($paymentMethod == 'transfer') ? ($subtotal * 0.10) : 0;
            $total = $subtotal - $discount;
            
            // Crear el pedido
            $order = Order::create([
                'user_id' => Auth::id(),
                'session_id' => $sessionId,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'payment_method' => $paymentMethod,
                'status' => 'pendiente'
            ]);
            
            // Crear los items del pedido
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }
            
            // Si el método de pago es MercadoPago, redirigir a MP
            if ($paymentMethod === 'mercadopago_checkout') {
                return redirect()->route('payment.create', $order->id);
            }

            // Vaciar el carrito
            Cart::where('session_id', $sessionId)->delete();
            
            
            
            return redirect()->route('orders.index')
                ->with('success', '¡Compra realizada con éxito! N° Pedido: #' . $order->id);
                
        } catch (\Exception $e) {
           dd($e);
        }
    }
}
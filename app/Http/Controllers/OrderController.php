<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $sessionId = Session::getId();
        $orders = Order::with('items.product')
            ->where('session_id', $sessionId)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('orders.index', compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('id', $id)
            ->firstOrFail();
            
        return view('orders.show', compact('order'));
    }
    
    public function destroy($id)
    {
        $sessionId = Session::getId();
        $order = Order::where('id', $id)
            ->where('session_id', $sessionId)
            ->firstOrFail();
        
        $order->delete();
        
        return redirect()->route('orders.index')->with('success', 'Pedido eliminado correctamente');
    }
    
    public function destroyAll()
    {
        $sessionId = Session::getId();
        Order::where('session_id', $sessionId)->delete();
        
        return redirect()->route('orders.index')->with('success', 'Todos los pedidos fueron eliminados');
    }
}
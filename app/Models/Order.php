<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'session_id', 'subtotal', 'discount', 'total', 'payment_method', 'status'
    ];
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
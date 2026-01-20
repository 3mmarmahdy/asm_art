<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'customer_phone', 'address', 'total_amount', 'status', 'session_id'];

    // الطلب يحتوي على العديد من العناصر (OrderItems)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
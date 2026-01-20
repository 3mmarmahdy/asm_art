<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        // التعديل هنا: جلب المنتج حتى لو كان محذوفاً (حذف ناعم)
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // السماح بتعبئة هذه البيانات
    protected $fillable = [
    'product_id', 
    'quantity', 
    'session_id', 
    'user_id' // <--- تمت الإضافة
];
    // علاقة السلة بالمنتج (كل سطر في السلة يملك منتجاً واحداً)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
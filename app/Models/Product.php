<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. إضافة هذا السطر

class Product extends Model
{
    use HasFactory, SoftDeletes; // 2. إضافة SoftDeletes هنا

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'category_id',
        'quantity' // لاحظت أنك تستخدمه في الكنترولر ولم يكن مضافاً هنا، فأضفته لك للاحتياط
    ];

    // علاقة: المنتج الواحد ينتمي لقسم واحد فقط
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image', // ضروري جداً عشان ميزة الصور اللي عملناها
    ];

    // علاقة: القسم الواحد يحتوي على منتجات كثيرة
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // 🔥 هذا السطر هو الحل السحري 🔥
    // بدلاً من fillable، نستخدم guarded فارغة لنسح بكتابة كل شيء بدون استثناء
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
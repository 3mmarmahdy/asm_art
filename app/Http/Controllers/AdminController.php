<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. عرض قائمة جميع الطلبات
    public function index()
    {
        // جلب الطلبات من الأحدث للأقدم
        $orders = Order::latest()->get();
        return view('admin.index', compact('orders'));
    }

    // 2. عرض تفاصيل طلب محدد (الفاتورة)
    public function show(Order $order)
    {
        // جلب الطلب مع تفاصيله (المنتجات)
        $order->load('items.product');
        return view('admin.show', compact('order'));
    }
}
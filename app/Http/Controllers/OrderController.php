<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    // ==========================
    // 1. الجزء الخاص بالعميل
    // ==========================

    public function index()
    {
        // جلب المنتجات حسب نوع المستخدم (مسجل أو زائر)
        if (auth()->check()) {
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        } else {
            $cartItems = Cart::where('session_id', Session::getId())->with('product')->get();
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index');
        }

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'address' => 'required|string',
        ]);

        // جلب السلة مرة أخرى لإتمام الطلب
        if (auth()->check()) {
            $cartItems = Cart::where('user_id', auth()->id())->get();
        } else {
            $cartItems = Cart::where('session_id', Session::getId())->get();
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index');
        }

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // إنشاء الطلب
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'address' => $request->address,
            'total_amount' => $total,
            'session_id' => Session::getId(),
            'status' => 'pending'
        ]);

        // نقل المنتجات من السلة إلى تفاصيل الطلب
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // تفريغ السلة بعد الشراء (حسب نوع المستخدم)
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->delete();
        } else {
            Cart::where('session_id', Session::getId())->delete();
        }

        return redirect()->route('products.index')->with('success', 'تم استلام طلبك بنجاح! رقم الطلب: #' . $order->id);
    }

    // ==========================
    // 2. الجزء الخاص بالمدير
    // ==========================

    public function adminIndex()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}
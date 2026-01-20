<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // 1. عرض صفحة السلة (مع إصلاح مشكلة المنتجات المحذوفة)
    public function index()
    {
        // جلب السلة حسب نوع المستخدم
        if (auth()->check()) {
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        } else {
            $cartItems = Cart::where('session_id', Session::getId())->with('product')->get();
        }

        // ✨ التعديل الجديد: تنظيف السلة تلقائياً ✨
        // نحذف أي عنصر في السلة لم يعد منتجه موجوداً في قاعدة البيانات
        $cartItems = $cartItems->filter(function ($item) {
            if (!$item->product) {
                $item->delete(); // حذف السطر من قاعدة بيانات السلة
                return false;    // استبعاده من القائمة الحالية
            }
            return true;
        });

        // حساب الإجمالي (الآن نضمن أن product موجود دائماً ولا يسبب خطأ)
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // 2. إضافة منتج للسلة
    public function addToCart($productId)
    {
        $sessionId = Session::getId();
        $userId = auth()->id();

        // البحث عن المنتج
        if (auth()->check()) {
            $cartItem = Cart::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();
        } else {
            $cartItem = Cart::where('session_id', $sessionId)
                            ->where('product_id', $productId)
                            ->first();
        }

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $productId,
                'quantity' => 1,
                'session_id' => $sessionId,
                'user_id' => $userId,
            ]);
        }

        return redirect()->back()->with('success', 'تمت إضافة المنتج للسلة بنجاح ✅');
    }

    // 3. حذف منتج من السلة
    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect()->route('cart.index');
    }
}
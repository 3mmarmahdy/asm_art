<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddToCartButton extends Component
{
    public $productId; 
    public $showSuccess = false; 

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function addToCart()
    {
        // 1. إذا كان زائر -> حوله للدخول فوراً
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $sessionId = Session::getId();

        // 2. منطق الإضافة (بدون تكرار)
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $this->productId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $this->productId,
                'quantity' => 1,
                'session_id' => $sessionId,
                'user_id' => $userId,
            ]);
        }

        // 3. إظهار رسالة نجاح
        $this->showSuccess = true;
        
        // إرسال حدث لتحديث العداد
        $this->dispatch('cartUpdated'); 
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
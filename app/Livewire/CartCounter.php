<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On; 

class CartCounter extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('cartUpdated')] // هذا السطر يستمع لحدث الإضافة من الزر الآخر
    public function updateCount()
    {
        if (Auth::check()) {
            $this->cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            $this->cartCount = Cart::where('session_id', Session::getId())->sum('quantity');
        }
    }

    public function render()
    {
        // تأكدنا أن المسار يطابق المجلد الذي أنشأته
        return view('livewire.cart-counter');
    }
}
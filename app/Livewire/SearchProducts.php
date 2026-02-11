<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class SearchProducts extends Component
{
    public $search = ''; // المتغير الذي يكتبه المستخدم

    public function render()
    {
        $products = [];

        // ابحث فقط إذا كتب المستخدم حرفين أو أكثر
        if (strlen($this->search) >= 2) {
            $products = Product::where('name', 'like', '%' . $this->search . '%')
                               ->take(5) // هات 5 نتائج فقط عشان الخفة
                               ->get();
        }

        return view('livewire.search-products', [
            'results' => $products
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => "Sultan's Black Ink",
            'price' => 24.99,
            'image' => 'https://via.placeholder.com/600',
            'description' => 'Premium black ink for calligraphy.',
        ]);

        Product::create([
            'name' => "Golden Kufic Kalam",
            'price' => 49.99,
            'image' => 'https://via.placeholder.com/600',
            'description' => 'A beautiful kalam pen for Kufic styles.',
        ]);

        Product::create([
            'name' => "Aged Papyrus Sheets",
            'price' => 19.99,
            'image' => 'https://via.placeholder.com/600',
            'description' => 'Pack of quality papyrus sheets.',
        ]);

        Product::create([
            'name' => "Thuluth Practice Set",
            'price' => 35.00,
            'image' => 'https://via.placeholder.com/600',
            'description' => 'Practice tools and guides for Thuluth.',
        ]);
    }
}

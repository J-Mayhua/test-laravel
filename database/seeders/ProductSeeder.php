<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Camiseta Overskull',
            'description' => 'Camiseta negra edición limitada',
            'price' => 89.90,
            'stock' => 50,
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Gorra Overskull',
            'description' => 'Gorra bordada',
            'price' => 49.90,
            'stock' => 30,
            'category_id' => 2,
        ]);
    }
}

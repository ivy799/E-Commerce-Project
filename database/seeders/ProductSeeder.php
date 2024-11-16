<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Store;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = Store::first(); // Assuming you have at least one store

        Product::create([
            'store_id' => $store->id,
            'name' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'price' => 99.99,
            'stock' => 10,
            'image' => 'product_images/sample.jpg',
            'category' => 'Sample Category',
        ]);

        // Add more products as needed
    }
}
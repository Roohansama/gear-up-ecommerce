<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $name = "Sample Product $i";
            Product::create([
                'name' => $name,
                'description' => 'This is a sample product description.',
                'slug' => Str::slug($name) . '-' . uniqid(),
                'price' => rand(100, 1000),
                'sale_price' => rand(50, 99),
                'stock' => rand(0, 50),
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'is_active' => true,
                'image_path' => 'products/sample.jpg',
                'category_id' => 1, // Make sure category with id 1 exists!
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 10; $i <= 20; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                ProductImage::create([
                    'product_id' => $i,
                    'image_path' => 'products/sample.jpg',
                ]);
            }
        }
    }
}

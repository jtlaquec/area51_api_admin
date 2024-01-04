<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagePaths = [
            'products/1.jpg',
            'products/2.jpg',
            'products/3.jpg',
            'products/4.jpg',
            'products/5.jpg',
            'products/6.jpg',
            'products/7.jpg',
            'products/8.jpg',
            'products/9.jpg',
            'products/10.jpg',
            'products/11.jpg',
            'products/12.jpg',
        ];

        $productVariants = ProductVariant::all();

        foreach ($productVariants as $variant) {
            $randomImagePaths = array_rand($imagePaths, 4);

            foreach ($randomImagePaths as $index) {
                Image::create([
                    'image_path' => $imagePaths[$index],
                    'product_variant_id' => $variant->id,
                ]);
            }
        }
    }
}

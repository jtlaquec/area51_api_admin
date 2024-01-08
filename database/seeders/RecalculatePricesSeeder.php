<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class RecalculatePricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        foreach ($products as $product) {
            if ($product->has_discount) {
                foreach ($product->productvariants as $variant) {
                    $discountPrice = $variant->price - ($variant->price * $product->percentage_discount / 100);
                    $variant->update(['discount_price' => $discountPrice]);
                }
            } else {
                foreach ($product->productvariants as $variant) {
                    $variant->update(['discount_price' => $variant->price]);
                }
            }
            $firstVariant = $product->productvariants()->first();
            if ($firstVariant) {
                $product->price = $firstVariant->discount_price;
                $product->save();
            }
        }

    }
}

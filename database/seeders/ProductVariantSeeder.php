<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = Product::all();
        $colors = Color::all();
        $sizes = Size::all();

        foreach ($products as $product) {
            // Número de variantes a crear por producto
            $numVariants = rand(1, 3);

            // Combinaciones de colores y tallas
            $allCombinations = [];
            foreach ($colors as $color) {
                foreach ($sizes as $size) {
                    $allCombinations[] = ['color_id' => $color->id, 'size_id' => $size->id];
                }
            }

            // Mezclamos las combinaciones
            shuffle($allCombinations);

            $selectedCombinations = array_slice($allCombinations, 0, $numVariants);

            foreach ($selectedCombinations as $combination) {
                $color = Color::find($combination['color_id']);
                $size = Size::find($combination['size_id']);

                // Agregamos al nombre de producto el color y talla
                $variantName = "{$product->name} {$color->description} {$size->value}";

                ProductVariant::factory()->create([
                    'product_id' => $product->id,
                    'color_id' => $color->id,
                    'size_id' => $size->id,
                    'name' => $variantName,
                ]);
            }
        }
    }
}

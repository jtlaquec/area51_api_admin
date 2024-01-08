<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {
        $subcategory = Subcategory::inRandomOrder()->first();
        $randomNumber = $this->faker->numberBetween(1, 12);
        $imageName = $randomNumber . '.jpg';
        $imagePath = 'products/' . $imageName;

        $hasDiscount = $this->faker->boolean();
        $percentageDiscount = $hasDiscount ? $this->faker->numberBetween(10, 90) : 0;

        $productDetails = [
            'Características' => 'Car1',
            'Tipo de tela' => 'Car2',
            'Instrucciones de uso' => 'Car3',
            'Clase' => 'Car4',
            'Composición' => 'Car5',
            'Tipo de manga' => 'Car6',
            'Tipo de tejido' => 'Car7',
            'Tipo de cuello' => 'Car8',
        ];

        return [
            'sku' => $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $subcategory->name . ' ' . $this->faker->sentence(),
            'brand' => $this->faker->text(10),
            'description' => $this->faker->text(200),
            /* 'image_path' => $imagePath, */
            'image_path' => 'products/' . $this->faker->image('public/storage/products',640,480,null,false),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'subcategory_id' => $subcategory->id,
            'product_details' => json_encode($productDetails, JSON_UNESCAPED_UNICODE),
            'has_discount' => $hasDiscount,
            'percentage_discount' => $percentageDiscount,
        ];
    }
}

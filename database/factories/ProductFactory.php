<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
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
        return [
            'sku' => 'SKU-' . $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $subcategory->name . ' ' . $this->faker->word,
            'description' => $this->faker->paragraph,
            'image_path' => 'path/to/image.jpg',
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'subcategory_id' => $subcategory->id,
        ];
    }
}

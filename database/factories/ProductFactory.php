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


        return [
            'sku' => $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $subcategory->name . ' ' . $this->faker->sentence(),
            'description' => $this->faker->text(200),
            'image_path' => $imagePath,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'subcategory_id' => $subcategory->id,
        ];
    }
}

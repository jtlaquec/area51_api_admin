<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $hasDiscount = $this->faker->boolean();
        $percentageDiscount = $hasDiscount ? $this->faker->numberBetween(10, 90) : 0;
        $price = $this->faker->randomFloat(2, 10, 1000);

        $discountPrice = $hasDiscount ? ($price - ($price * $percentageDiscount)/100) : $price;


        return [
            'sku' => $this->faker->unique()->lexify('SKU??????'),
            'stock' => $this->faker->numberBetween(0, 100),
            'slug' => $this->faker->unique()->slug(),
            'is_active' => 1,
            'price' => $price,
            'has_discount' => $hasDiscount,
            'discount_price' => $discountPrice,
            'percentage_discount' => $percentageDiscount,
        ];
    }
}

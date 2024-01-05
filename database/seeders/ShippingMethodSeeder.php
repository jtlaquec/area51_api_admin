<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippingMethods = [
            [
                'name' => 'Recojo en Tienda (Tacna)',
            ],
            [
                'name' => 'Envío por Shalom',
            ],

        ];

        foreach ($shippingMethods as $shippingMethod) {
            ShippingMethod::create($shippingMethod);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'name' => 'Billetera Digital',
            ],
            [
                'name' => 'Transferencias Bancarias',
            ],
            [
                'name' => 'Efectivo',
            ],
            [
                'name' => 'Pago en Tienda',
            ],

        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::create($paymentMethod);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\PaymentState;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            [
                'name' => 'Pendiente',
            ],
            [
                'name' => 'Verificado',
            ],
            [
                'name' => 'Rechazado',
            ],

        ];

        foreach ($states as $state) {
            PaymentState::create($state);
        }
    }
}

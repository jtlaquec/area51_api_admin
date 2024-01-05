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
                'name' => 'PENDIENTE',
            ],
            [
                'name' => 'VERIFICADO',
            ],
            [
                'name' => 'RECHAZADO',
            ],

        ];

        foreach ($states as $state) {
            PaymentState::create($state);
        }
    }
}

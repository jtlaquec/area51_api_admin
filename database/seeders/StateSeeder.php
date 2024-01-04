<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            [
                'name' => 'Confirmando',
            ],
            [
                'name' => 'Preparando',
            ],
            [
                'name' => 'Preparado',
            ],
            [
                'name' => 'Enviado',
            ],
            [
                'name' => 'Entregado',
            ],
            [
                'name' => 'Devolución',
            ],


        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            [
                'value' => '#000000',
                'description' => 'Negro',
            ],
            [
                'value' => '#ffffff',
                'description' => 'Blanco',
            ],
            [
                'value' => '#ff0000',
                'description' => 'Rojo',
            ],
            [
                'value' => '#00ff00',
                'description' => 'Verde',
            ],
            [
                'value' => '#0000ff',
                'description' => 'Azul',
            ],
            [
                'value' => '#ffff00',
                'description' => 'Amarillo',
            ],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}

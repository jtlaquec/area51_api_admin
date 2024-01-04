<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            [
                'value' => 'XS',
                'description' => 'Extra Small',
            ],
            [
                'value' => 'S',
                'description' => 'Small',
            ],
            [
                'value' => 'M',
                'description' => 'Medium',
            ],
            [
                'value' => 'L',
                'description' => 'Large',
            ],
            [
                'value' => 'XL',
                'description' => 'Extra Large',
            ],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}

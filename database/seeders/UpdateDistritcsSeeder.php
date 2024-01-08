<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdateDistritcsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = District::where('department_id', 23)->get();

        foreach ($districts as $district) {
            $district->update([
                'shipping_cost' => 0,
            ]);
        }
    }
}

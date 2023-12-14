<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Alexander Gabriel Cairo Flores',
                'email' => 'alexander@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Grober Glenn Quispe Aguilar',
                'email' => 'grober@gmail.com',
                'password' => Hash::make('12345678'),
            ],

            [
                'name' => 'Xavier Anthony Ale Ninaja',
                'email' => 'xavier@gmail.com',
                'password' => Hash::make('12345678'),
            ],

            [
                'name' => 'Felix Fernando Quispe Sentecala',
                'email' => 'felix@gmail.com',
                'password' => Hash::make('12345678'),
            ],

            [
                'name' => 'Julián Thomy Laque Cauna',
                'email' => 'julian@gmail.com',
                'password' => Hash::make('12345678'),
            ],

        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}

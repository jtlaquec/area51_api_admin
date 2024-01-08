<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Administrador', 'Vendedor', 'Cliente'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }


        $users = [

            [
                'name' => 'Alexander Gabriel Cairo Flores',
                'email' => 'alexander@gmail.com',
                'password' => Hash::make('12345678'),
                'district_id' => 230101,
                'phone' => '957034285',
                'birth_date' => '2001-01-01',
                'document' => '57034285',
                'address' => 'La Molina',
            ],
            [
                'name' => 'Grober Glenn Quispe Aguilar',
                'email' => 'grober@gmail.com',
                'password' => Hash::make('12345678'),
                'district_id' => 230101,
                'phone' => '921323101',
                'birth_date' => '2001-01-01',
                'document' => '21323101',
                'address' => 'San Juan de Lurigancho',
            ],

            [
                'name' => 'Xavier Anthony Ale Ninaja',
                'email' => 'xavier@gmail.com',
                'password' => Hash::make('12345678'),
                'district_id' => 230101,
                'phone' => '938566913',
                'birth_date' => '2001-01-01',
                'document' => '38566913',
                'address' => 'Viñani - entrada nomas',
            ],

            [
                'name' => 'Felix Fernando Quispe Sentecala',
                'email' => 'felix@gmail.com',
                'password' => Hash::make('12345678'),
                'district_id' => 230101,
                'phone' => '927917164',
                'birth_date' => '2001-01-01',
                'document' => '27917164',
                'address' => 'El Callao',
            ],

            [
                'name' => 'Julián Thomy Laque Cauna',
                'email' => 'julian@gmail.com',
                'password' => Hash::make('12345678'),
                'district_id' => 230101,
                'phone' => '969853571',
                'birth_date' => '2001-01-01',
                'document' => '69853571',
                'address' => 'Tacna',
            ],

            [
                'name' => 'Cliente',
                'email' => 'cliente@gmail.com',
                'password' => Hash::make('12345678'),
                'district_id' => 230101,
                'phone' => '931451245',
                'birth_date' => '2001-01-01',
                'document' => '75010101',
                'address' => 'av. siempre viva 123',
            ],

        ];

        foreach ($users as $index => $userData) {

            $user = User::create($userData);
            $role = Role::findByName($roles[$index % count($roles)]);
            $user->assignRole($role);
        }


        $clientRole = Role::firstOrCreate(['name' => 'Cliente']);
        User::factory(20)->create()->each(function ($user) use ($clientRole) {
            $user->assignRole($clientRole);
        });
    }
}

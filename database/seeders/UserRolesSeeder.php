<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $roles = ['Administrador', 'Vendedor', 'Cliente'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Vendedor User',
                'email' => 'vendedor@gmail.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'Cliente User',
                'email' => 'cliente@gmail.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(['email' => $userData['email']], $userData);

            if ($userData['email'] == 'admin@gmail.com') {
                $user->assignRole('Administrador');
            } elseif ($userData['email'] == 'vendedor@gmail.com') {
                $user->assignRole('Vendedor');
            } elseif ($userData['email'] == 'cliente@gmail.com') {
                $user->assignRole('Cliente');
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = [
            'Moda Hombre' => [
                'Tendencias y colecciones' => [
                    'Colección de verano',
                    'Lo mas nuevo',
                ],
                'Ropa de hombre por tipo' => [
                    'Abrigos',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Trajes',
                    'Zapatos',
                ],
                'Accesorios' => [
                    'Billeteras',
                    'Cinturones',
                    'Corbatas',
                    'Gorros',
                    'Gafas',
                    'Guantes',
                    'Mochilas',
                    'Otros',
                    'Relojes',
                    'Sombreros',
                ],
                'Ropa interior y pijamas' => [
                    'Boxers',
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado hombre' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
            'Moda Mujer' => [
                'Tendencias y colecciones' => [
                    'Colección de verano',
                    'Lo mas nuevo',
                    'Comodidad',
                    'Colección otoño invierno',
                ],
                'Ropa de mujer por tipo' => [
                    'Abrigos',
                    'Blusas',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Vestidos',
                    'Zapatos',
                ],
                'Accesorios' => [
                    'Billeteras',
                    'Cinturones',
                    'Gorros',
                    'Gafas',
                    'Guantes',
                    'Mochilas',
                    'Otros',
                    'Relojes',
                    'Sombreros',
                ],
                'Ropa interior y pijamas' => [
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado mujer' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
        ];


        foreach ($families as $family => $categories){

            $family = Family::create([
                'name' => $family,
            ]);

            foreach ($categories as $category => $subcategories){

                $category = Category::create([
                    'name' => $category,
                    'family_id' => $family->id,
                ]);

                foreach ($subcategories as $subcategory){

                Subcategory::create([
                    'name' => $subcategory,
                    'category_id' => $category->id,
                ]);
                }
            }
        }
    }
}

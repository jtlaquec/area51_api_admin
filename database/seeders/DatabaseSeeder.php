<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
/*         Storage::deleteDirectory('products');
        Storage::makeDirectory('products'); */


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            DepartmentSeeder::class,
            ProvinceSeeder::class,
            DistrictSeeder::class,
            FamilySeeder::class,
            UserSeeder::class,
            OptionSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            StateSeeder::class,
            PaymentMethodSeeder::class,
            PaymentSeeder::class,
            PaymentStateSeeder::class,
            ShippingMethodSeeder::class,

        ]);

        Product::factory(150)->create();
        Comment::factory(50)->create();

        $this->call([
            ProductVariantSeeder::class,
            ImageSeeder::class,
            RecalculatePricesSeeder::class,

        ]);
    }
}

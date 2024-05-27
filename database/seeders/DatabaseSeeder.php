<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            VendorsTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            GoodsReceivedNoteSeeder::class,
            GoodsReceivedNoteDetailSeeder::class,
            CartsTableSeeder::class,
            CartDetailSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class
        ]);
    }
}

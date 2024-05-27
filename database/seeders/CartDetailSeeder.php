<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'cart_id' => 15,
                'product_id' => 5,
                'quantity' => 1.00,
                'price' => 161400,
                'created_at' => '2024-05-08 17:58:00',
                'updated_at' => '2024-05-08 17:58:00',
            ],
            [
                'cart_id' => 15,
                'product_id' => 25,
                'quantity' => 1.00,
                'price' => 156000,
                'created_at' => '2024-05-08 17:58:14',
                'updated_at' => '2024-05-08 17:58:14',
            ],
            [
                'cart_id' => 30,
                'product_id' => 10,
                'quantity' => 1.00,
                'price' => 99000,
                'created_at' => '2024-05-19 00:33:04',
                'updated_at' => '2024-05-19 00:33:04',
            ],
            [
                'cart_id' => 30,
                'product_id' => 21,
                'quantity' => 1.00,
                'price' => 45000,
                'created_at' => '2024-05-19 00:45:38',
                'updated_at' => '2024-05-19 00:45:38',
            ],
        ];

        DB::table('cart_details')->insert($data);
    }
}

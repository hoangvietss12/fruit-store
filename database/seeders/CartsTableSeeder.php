<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'id' => 15,
                'user_id' => 3,
                'created_at' => '2024-05-08 06:59:39',
                'updated_at' => '2024-05-08 06:59:39',
            ],
            [
                'id' => 17,
                'user_id' => 12,
                'created_at' => '2024-05-16 23:39:58',
                'updated_at' => '2024-05-16 23:39:58',
            ],
            [
                'id' => 27,
                'user_id' => 4,
                'created_at' => '2024-05-18 16:57:10',
                'updated_at' => '2024-05-18 16:57:10',
            ],
            [
                'id' => 30,
                'user_id' => 9,
                'created_at' => '2024-05-19 00:33:04',
                'updated_at' => '2024-05-19 00:33:04',
            ],
        ]);
    }
}

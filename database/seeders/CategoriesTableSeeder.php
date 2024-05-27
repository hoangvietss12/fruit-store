<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Trái cây nhập khẩu',
                'created_at' => '2024-04-25 03:20:52',
                'updated_at' => '2024-05-04 00:52:43',
            ],
            [
                'id' => 2,
                'name' => 'Trái cây Việt',
                'created_at' => '2024-04-26 00:37:48',
                'updated_at' => '2024-04-26 00:37:48',
            ],
            [
                'id' => 3,
                'name' => 'Giỏ quà trái cây',
                'created_at' => '2024-04-26 00:37:55',
                'updated_at' => '2024-04-26 00:37:55',
            ],
        ]);
    }
}

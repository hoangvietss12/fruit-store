<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vendors')->insert([
            [
                'id' => 1,
                'name' => 'Hải Đăng Fruit',
                'email' => 'info@haidanggfruit.com',
                'phone' => '024 1234 5678',
                'address' => 'Số 10, Ngõ 45, Lê Văn Lương, Thanh Xuân, Hà Nội',
                'created_at' => '2024-04-25 03:24:23',
                'updated_at' => '2024-05-03 20:29:33',
            ],
            [
                'id' => 3,
                'name' => 'Thăng Long Fruit Company',
                'email' => 'contact@thanglongfruit.com',
                'phone' => '024 5678 1234',
                'address' => 'Đường Lê Văn Lương, Thanh Xuân, Hà Nội',
                'created_at' => '2024-04-26 00:41:35',
                'updated_at' => '2024-04-26 00:41:35',
            ],
            [
                'id' => 4,
                'name' => 'Tân Mai Fruit Mart',
                'email' => 'info@tanmaifruitmart.com',
                'phone' => '024 4567 8901',
                'address' => 'Số 15, Ngõ 32, Cầu Giấy, Hà Nội',
                'created_at' => '2024-04-26 00:42:03',
                'updated_at' => '2024-04-26 00:42:03',
            ],
            [
                'id' => 5,
                'name' => 'Quang An Fruit Center',
                'email' => 'quangfruitcenter@gmail.com',
                'phone' => '024 2345 6789',
                'address' => 'Số 12, Phố Xuân Diệu, Tây Hồ, Hà Nội',
                'created_at' => '2024-04-26 00:42:30',
                'updated_at' => '2024-04-26 00:42:48',
            ],
            [
                'id' => 6,
                'name' => 'Hoàng Gia Fruit',
                'email' => 'hoanggiafruit@gmail.com',
                'phone' => '024 9876 5432',
                'address' => 'Số 20, Phố Hàng Điếu, Hoàn Kiếm, Hà Nội',
                'created_at' => '2024-04-26 00:43:15',
                'updated_at' => '2024-04-26 00:43:15',
            ],
        ]);
    }
}

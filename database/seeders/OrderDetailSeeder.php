<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'order_id' => 19,
                'product_id' => 10,
                'quantity' => 1.00,
                'price' => 79200,
                'total_price' => 79200.00,
                'created_at' => '2024-05-08 06:57:30',
                'updated_at' => '2024-05-08 06:57:30',
            ],
            [
                'order_id' => 19,
                'product_id' => 6,
                'quantity' => 1.40,
                'price' => 80100,
                'total_price' => 112140.00,
                'created_at' => '2024-05-08 06:57:30',
                'updated_at' => '2024-05-08 06:57:30',
            ],
            [
                'order_id' => 20,
                'product_id' => 14,
                'quantity' => 1.00,
                'price' => 194650,
                'total_price' => 194650.00,
                'created_at' => '2024-05-11 06:59:18',
                'updated_at' => '2024-05-08 06:59:18',
            ],
            [
                'order_id' => 20,
                'product_id' => 5,
                'quantity' => 1.50,
                'price' => 161400,
                'total_price' => 242100.00,
                'created_at' => '2024-05-11 06:59:18',
                'updated_at' => '2024-05-08 06:59:18',
            ],
            [
                'order_id' => 21,
                'product_id' => 5,
                'quantity' => 1.00,
                'price' => 161400,
                'total_price' => 161400.00,
                'created_at' => '2024-05-09 18:17:33',
                'updated_at' => '2024-05-08 18:17:33',
            ],
            [
                'order_id' => 21,
                'product_id' => 25,
                'quantity' => 1.00,
                'price' => 137280,
                'total_price' => 137280.00,
                'created_at' => '2024-05-09 18:17:33',
                'updated_at' => '2024-05-08 18:17:33',
            ],
            [
                'order_id' => 22,
                'product_id' => 16,
                'quantity' => 1.10,
                'price' => 129000,
                'total_price' => 141900.00,
                'created_at' => '2024-05-14 23:33:39',
                'updated_at' => '2024-05-16 23:33:39',
            ],
            [
                'order_id' => 22,
                'product_id' => 14,
                'quantity' => 0.70,
                'price' => 194650,
                'total_price' => 136255.00,
                'created_at' => '2024-05-14 23:33:39',
                'updated_at' => '2024-05-16 23:33:39',
            ],
            [
                'order_id' => 22,
                'product_id' => 11,
                'quantity' => 1.00,
                'price' => 396000,
                'total_price' => 396000.00,
                'created_at' => '2024-05-14 23:33:39',
                'updated_at' => '2024-05-16 23:33:39',
            ],
            [
                'order_id' => 22,
                'product_id' => 14,
                'quantity' => 0.70,
                'price' => 194650,
                'total_price' => 136255.00,
                'created_at' => '2024-05-14 23:33:39',
                'updated_at' => '2024-05-16 23:33:39',
            ],
            [
                'order_id' => 22,
                'product_id' => 11,
                'quantity' => 1.00,
                'price' => 396000,
                'total_price' => 396000.00,
                'created_at' => '2024-05-14 23:33:39',
                'updated_at' => '2024-05-16 23:33:39',
            ],
            [
                'order_id' => 23,
                'product_id' => 24,
                'quantity' => 0.30,
                'price' => 222400,
                'total_price' => 66720.00,
                'created_at' => '2024-05-15 23:42:26',
                'updated_at' => '2024-05-16 23:42:26',
            ],
            [
                'order_id' => 23,
                'product_id' => 24,
                'quantity' => 0.30,
                'price' => 222400,
                'total_price' => 66720.00,
                'created_at' => '2024-05-15 23:42:26',
                'updated_at' => '2024-05-16 23:42:26',
            ],
            [
                'order_id' => 23,
                'product_id' => 33,
                'quantity' => 0.70,
                'price' => 33750,
                'total_price' => 23625.00,
                'created_at' => '2024-05-15 23:42:26',
                'updated_at' => '2024-05-16 23:42:26',
            ],
            [
                'order_id' => 23,
                'product_id' => 28,
                'quantity' => 0.50,
                'price' => 59500,
                'total_price' => 29750.00,
                'created_at' => '2024-05-15 23:42:26',
                'updated_at' => '2024-05-16 23:42:26',
            ],
            [
                'order_id' => 24,
                'product_id' => 8,
                'quantity' => 1.50,
                'price' => 69420,
                'total_price' => 104130.00,
                'created_at' => '2024-05-16 06:45:35',
                'updated_at' => '2024-05-16 23:45:35',
            ],
            [
                'order_id' => 24,
                'product_id' => 7,
                'quantity' => 0.40,
                'price' => 399000,
                'total_price' => 159600.00,
                'created_at' => '2024-05-16 06:45:35',
                'updated_at' => '2024-05-16 23:45:35',
            ],
            [
                'order_id' => 24,
                'product_id' => 27,
                'quantity' => 1.20,
                'price' => 78000,
                'total_price' => 93600.00,
                'created_at' => '2024-05-16 06:45:35',
                'updated_at' => '2024-05-16 23:45:35',
            ],
            [
                'order_id' => 24,
                'product_id' => 30,
                'quantity' => 0.70,
                'price' => 208485,
                'total_price' => 145939.50,
                'created_at' => '2024-05-16 06:45:35',
                'updated_at' => '2024-05-16 23:45:35',
            ],
            [
                'order_id' => 25,
                'product_id' => 17,
                'quantity' => 1.70,
                'price' => 318750,
                'total_price' => 541875.00,
                'created_at' => '2024-05-18 06:44:27',
                'updated_at' => '2024-05-17 23:44:27',
            ],
            [
                'order_id' => 25,
                'product_id' => 29,
                'quantity' => 2.60,
                'price' => 29000,
                'total_price' => 75400.00,
                'created_at' => '2024-05-18 06:44:27',
                'updated_at' => '2024-05-17 23:44:27',
            ],
            [
                'order_id' => 25,
                'product_id' => 31,
                'quantity' => 1.40,
                'price' => 71200,
                'total_price' => 99680.00,
                'created_at' => '2024-05-18 06:44:27',
                'updated_at' => '2024-05-17 23:44:27',
            ],
            [
                'order_id' => 25,
                'product_id' => 32,
                'quantity' => 3.00,
                'price' => 37000,
                'total_price' => 111000.00,
                'created_at' => '2024-05-18 06:44:27',
                'updated_at' => '2024-05-17 23:44:27',
            ],
            [
                'order_id' => 26,
                'product_id' => 10,
                'quantity' => 1.80,
                'price' => 79200,
                'total_price' => 142560.00,
                'created_at' => '2024-05-18 06:47:54',
                'updated_at' => '2024-05-17 23:47:54',
            ],
            [
                'order_id' => 26,
                'product_id' => 15,
                'quantity' => 2.60,
                'price' => 89000,
                'total_price' => 231400.00,
                'created_at' => '2024-05-18 06:47:54',
                'updated_at' => '2024-05-17 23:47:54',
            ],
            [
                'order_id' => 27,
                'product_id' => 6,
                'quantity' => 0.60,
                'price' => 80100,
                'total_price' => 48060.00,
                'created_at' => '2024-05-18 06:50:55',
                'updated_at' => '2024-05-17 23:50:55',
            ],
            [
                'order_id' => 27,
                'product_id' => 21,
                'quantity' => 2.00,
                'price' => 45000,
                'total_price' => 90000.00,
                'created_at' => '2024-05-18 06:50:55',
                'updated_at' => '2024-05-17 23:50:55',
            ],
            [
                'order_id' => 27,
                'product_id' => 23,
                'quantity' => 1.80,
                'price' => 99000,
                'total_price' => 178200.00,
                'created_at' => '2024-05-18 06:50:55',
                'updated_at' => '2024-05-17 23:50:55',
            ],
            [
                'order_id' => 27,
                'product_id' => 22,
                'quantity' => 3.00,
                'price' => 149000,
                'total_price' => 447000.00,
                'created_at' => '2024-05-18 06:50:55',
                'updated_at' => '2024-05-17 23:50:55',
            ],
            [
                'order_id' => 27,
                'product_id' => 20,
                'quantity' => 2.50,
                'price' => 163800,
                'total_price' => 409500.00,
                'created_at' => '2024-05-18 06:50:55',
                'updated_at' => '2024-05-17 23:50:55',
            ],
            [
                'order_id' => 27,
                'product_id' => 18,
                'quantity' => 2.40,
                'price' => 89000,
                'total_price' => 213600.00,
                'created_at' => '2024-05-18 06:50:55',
                'updated_at' => '2024-05-17 23:50:55',
            ],
            [
                'order_id' => 28,
                'product_id' => 25,
                'quantity' => 3.40,
                'price' => 137280,
                'total_price' => 466752.00,
                'created_at' => '2024-05-18 06:53:02',
                'updated_at' => '2024-05-17 23:53:02',
            ],
            [
                'order_id' => 29,
                'product_id' => 25,
                'quantity' => 1.00,
                'price' => 137280,
                'total_price' => 137280.00,
                'created_at' => '2024-05-18 07:23:02',
                'updated_at' => '2024-05-18 00:23:02',
            ],
            [
                'order_id' => 30,
                'product_id' => 8,
                'quantity' => 1.50,
                'price' => 69420,
                'total_price' => 104130.00,
                'created_at' => '2024-05-18 07:55:44',
                'updated_at' => '2024-05-18 00:55:44',
            ],
            [
                'order_id' => 31,
                'product_id' => 33,
                'quantity' => 0.70,
                'price' => 33750,
                'total_price' => 23625.00,
                'created_at' => '2024-05-18 07:57:45',
                'updated_at' => '2024-05-18 00:57:45',
            ],
            [
                'order_id' => 32,
                'product_id' => 6,
                'quantity' => 0.60,
                'price' => 80100,
                'total_price' => 48060.00,
                'created_at' => '2024-05-18 23:52:47',
                'updated_at' => '2024-05-18 16:52:47',
            ],
            [
                'order_id' => 32,
                'product_id' => 7,
                'quantity' => 0.50,
                'price' => 399000,
                'total_price' => 199500.00,
                'created_at' => '2024-05-18 23:52:47',
                'updated_at' => '2024-05-18 16:52:47',
            ],
            [
                'order_id' => 32,
                'product_id' => 28,
                'quantity' => 1.00,
                'price' => 59500,
                'total_price' => 59500.00,
                'created_at' => '2024-05-18 23:52:47',
                'updated_at' => '2024-05-18 16:52:47',
            ],
            [
                'order_id' => 32,
                'product_id' => 5,
                'quantity' => 1.00,
                'price' => 161400,
                'total_price' => 161400.00,
                'created_at' => '2024-05-18 23:52:47',
                'updated_at' => '2024-05-18 16:52:47',
            ],
            [
                'order_id' => 33,
                'product_id' => 32,
                'quantity' => 1.50,
                'price' => 37000,
                'total_price' => 55500.00,
                'created_at' => '2024-05-18 23:56:08',
                'updated_at' => '2024-05-18 16:56:08',
            ],
            [
                'order_id' => 33,
                'product_id' => 30,
                'quantity' => 1.00,
                'price' => 208485,
                'total_price' => 208485.00,
                'created_at' => '2024-05-18 23:56:08',
                'updated_at' => '2024-05-18 16:56:08',
            ],
            [
                'order_id' => 34,
                'product_id' => 17,
                'quantity' => 2.00,
                'price' => 318750,
                'total_price' => 637500.00,
                'created_at' => '2024-05-18 23:59:36',
                'updated_at' => '2024-05-18 16:59:36',
            ],
            [
                'order_id' => 34,
                'product_id' => 25,
                'quantity' => 1.70,
                'price' => 137280,
                'total_price' => 233376.00,
                'created_at' => '2024-05-18 23:59:36',
                'updated_at' => '2024-05-18 16:59:36',
            ],
            [
                'order_id' => 37,
                'product_id' => 22,
                'quantity' => 1.50,
                'price' => 149000,
                'total_price' => 223500.00,
                'created_at' => '2024-05-19 00:04:33',
                'updated_at' => '2024-05-18 17:04:33',
            ],
            [
                'order_id' => 41,
                'product_id' => 7,
                'quantity' => 0.60,
                'price' => 399000,
                'total_price' => 239400.00,
                'created_at' => '2024-05-20 03:10:38',
                'updated_at' => '2024-05-19 20:10:38',
            ],
            [
                'order_id' => 42,
                'product_id' => 8,
                'quantity' => 1.20,
                'price' => 69420,
                'total_price' => 83304.00,
                'created_at' => '2024-05-20 03:12:21',
                'updated_at' => '2024-05-19 20:12:21',
            ],
        ];

        DB::table('order_details')->insert($data);
    }
}
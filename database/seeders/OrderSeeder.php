<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 19,
                'user_id' => 3,
                'total' => 353550.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-08 06:57:30',
                'updated_at' => '2024-05-08 06:58:00',
            ],
            [
                'id' => 20,
                'user_id' => 3,
                'total' => 471100.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-11 06:59:18',
                'updated_at' => '2024-05-08 06:59:30',
            ],
            [
                'id' => 21,
                'user_id' => 3,
                'total' => 317400.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Chờ xác nhận',
                'created_at' => '2024-05-09 18:17:33',
                'updated_at' => '2024-05-08 18:17:33',
            ],
            [
                'id' => 22,
                'user_id' => 12,
                'total' => 713200.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-14 23:33:39',
                'updated_at' => '2024-05-16 23:33:53',
            ],
            [
                'id' => 23,
                'user_id' => 13,
                'total' => 144650.00,
                'order_type' => 'Thanh toán VN Pay',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-15 23:42:26',
                'updated_at' => '2024-05-16 23:43:57',
            ],
            [
                'id' => 24,
                'user_id' => 8,
                'total' => 564675.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-16 06:45:35',
                'updated_at' => '2024-05-16 23:45:54',
            ],
            [
                'id' => 25,
                'user_id' => 7,
                'total' => 867875.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 06:44:27',
                'updated_at' => '2024-05-17 23:46:48',
            ],
            [
                'id' => 26,
                'user_id' => 9,
                'total' => 424600.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 06:47:54',
                'updated_at' => '2024-05-17 23:48:13',
            ],
            [
                'id' => 27,
                'user_id' => 5,
                'total' => 1507200.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 06:50:55',
                'updated_at' => '2024-05-17 23:51:15',
            ],
            [
                'id' => 28,
                'user_id' => 6,
                'total' => 530400.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 06:53:02',
                'updated_at' => '2024-05-18 00:15:23',
            ],
            [
                'id' => 29,
                'user_id' => 6,
                'total' => 156000.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 07:23:02',
                'updated_at' => '2024-05-18 00:51:03',
            ],
            [
                'id' => 30,
                'user_id' => 6,
                'total' => 148500.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 07:55:44',
                'updated_at' => '2024-05-18 00:56:23',
            ],
            [
                'id' => 31,
                'user_id' => 6,
                'total' => 31500.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 07:57:45',
                'updated_at' => '2024-05-18 00:57:58',
            ],
            [
                'id' => 32,
                'user_id' => 4,
                'total' => 488800.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 23:52:47',
                'updated_at' => '2024-05-18 16:53:10',
            ],
            [
                'id' => 33,
                'user_id' => 4,
                'total' => 324750.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 23:56:08',
                'updated_at' => '2024-05-18 16:56:37',
            ],
            [
                'id' => 34,
                'user_id' => 13,
                'total' => 917700.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-18 23:59:36',
                'updated_at' => '2024-05-18 17:05:22',
            ],
            [
                'id' => 37,
                'user_id' => 9,
                'total' => 223500.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-19 00:04:33',
                'updated_at' => '2024-05-18 17:05:12',
            ],
            [
                'id' => 41,
                'user_id' => 6,
                'total' => 239400.00,
                'order_type' => 'Đến lấy hàng',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-20 03:10:38',
                'updated_at' => '2024-05-19 20:10:52',
            ],
            [
                'id' => 42,
                'user_id' => 7,
                'total' => 98304.00,
                'order_type' => 'Ship tận nơi',
                'status' => 'Đã xác nhận',
                'created_at' => '2024-05-20 03:12:21',
                'updated_at' => '2024-05-19 20:12:34',
            ],
        ];

        DB::table('orders')->insert($data);
    }
}

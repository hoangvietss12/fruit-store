<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsReceivedNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 2,
                'vendor_id' => 1,
                'total' => 1200000.00,
                'created_at' => '2024-05-08 00:34:51',
                'updated_at' => '2024-05-05 00:35:02',
            ],
            [
                'id' => 3,
                'vendor_id' => 1,
                'total' => 7700000.00,
                'created_at' => '2024-05-02 00:35:35',
                'updated_at' => '2024-05-05 00:36:54',
            ],
            [
                'id' => 4,
                'vendor_id' => 3,
                'total' => 800000.00,
                'created_at' => '2024-04-14 00:47:21',
                'updated_at' => '2024-05-05 00:48:34',
            ],
            [
                'id' => 5,
                'vendor_id' => 3,
                'total' => 4550000.00,
                'created_at' => '2024-04-07 00:48:48',
                'updated_at' => '2024-05-05 00:50:11',
            ],
            [
                'id' => 6,
                'vendor_id' => 4,
                'total' => 2130000.00,
                'created_at' => '2024-04-02 00:50:30',
                'updated_at' => '2024-05-05 00:51:47',
            ],
            [
                'id' => 7,
                'vendor_id' => 4,
                'total' => 1225500.00,
                'created_at' => '2024-03-12 00:51:58',
                'updated_at' => '2024-05-05 00:52:53',
            ],
            [
                'id' => 8,
                'vendor_id' => 5,
                'total' => 2090000.00,
                'created_at' => '2024-03-10 00:53:09',
                'updated_at' => '2024-05-05 00:54:32',
            ],
            [
                'id' => 9,
                'vendor_id' => 5,
                'total' => 3485000.00,
                'created_at' => '2024-03-09 00:54:43',
                'updated_at' => '2024-03-05 00:56:19',
            ],
            [
                'id' => 10,
                'vendor_id' => 6,
                'total' => 3330000.00,
                'created_at' => '2024-03-07 00:56:45',
                'updated_at' => '2024-03-07 00:57:54',
            ],
            [
                'id' => 11,
                'vendor_id' => 6,
                'total' => 3680000.00,
                'created_at' => '2024-03-07 00:58:01',
                'updated_at' => '2024-03-07 00:59:42',
            ],
            [
                'id' => 13,
                'vendor_id' => 4,
                'total' => 277000.00,
                'created_at' => '2024-05-17 06:52:12',
                'updated_at' => '2024-05-16 23:53:36',
            ],
            [
                'id' => 14,
                'vendor_id' => 6,
                'total' => 366300.00,
                'created_at' => '2024-05-17 06:56:15',
                'updated_at' => '2024-05-16 23:56:48',
            ],
            [
                'id' => 15,
                'vendor_id' => 3,
                'total' => 358000.00,
                'created_at' => '2024-05-17 06:58:34',
                'updated_at' => '2024-05-16 23:59:52',
            ],
            [
                'id' => 16,
                'vendor_id' => 4,
                'total' => 300000.00,
                'created_at' => '2024-05-18 06:57:48',
                'updated_at' => '2024-05-17 23:58:40',
            ],
            [
                'id' => 23,
                'vendor_id' => 1,
                'total' => 100000.00,
                'created_at' => '2024-05-19 08:32:41',
                'updated_at' => '2024-05-19 01:32:48',
            ],
            [
                'id' => 24,
                'vendor_id' => 4,
                'total' => 300000.00,
                'created_at' => '2024-05-19 08:33:20',
                'updated_at' => '2024-05-19 01:33:27',
            ],
            [
                'id' => 25,
                'vendor_id' => 4,
                'total' => 300000.00,
                'created_at' => '2024-05-19 08:34:01',
                'updated_at' => '2024-05-19 01:34:25',
            ],
            [
                'id' => 26,
                'vendor_id' => 3,
                'total' => 120000.00,
                'created_at' => '2024-05-20 03:13:19',
                'updated_at' => '2024-05-19 20:13:36',
            ],
        ];

        DB::table('goods_received_note')->insert($data);
    }
}

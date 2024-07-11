<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id' => 5,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => 'Táo Envy Mỹ',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668e9f3320043.webp", "products/668e9f33ac8be.webp", "products/668e9f33ebe40.webp"]',
                'unit' => 'kg',
                'quantity' => 7.40,
                'price' => 161400,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 6,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => 'Cherry đỏ Mỹ',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668e9f93ed663.webp"]',
                'unit' => 'kg',
                'quantity' => 4.90,
                'price' => 89000,
                'discount' => 0.10,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 7,
                'category_id' => 1,
                'vendor_id' => 6,
                'name' => 'Nho mẫu đơn Premium Hàn Quốc',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668e9faeaefd4.webp", "products/668e9faf059b1.webp", "products/668e9faf2fa99.webp"]',
                'unit' => 'kg',
                'quantity' => 8.00,
                'price' => 399000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 8,
                'category_id' => 2,
                'vendor_id' => 3,
                'name' => 'Bưởi da xanh',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668e9fd84e01f.webp", "products/668e9fd8bb993.webp", "products/668e9fd900a43.webp"]',
                'unit' => 'kg',
                'quantity' => 6.30,
                'price' => 89000,
                'discount' => 0.22,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 9,
                'category_id' => 2,
                'vendor_id' => 3,
                'name' => 'Cam sành',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668e9ff68cfef.webp"]',
                'unit' => 'kg',
                'quantity' => 8.70,
                'price' => 27000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 10,
                'category_id' => 1,
                'vendor_id' => 5,
                'name' => 'Cam vàng Ai Cập',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea01c80721.webp", "products/668ea01d15586.webp", "products/668ea01d46b0e.webp"]',
                'unit' => 'kg',
                'quantity' => 5.50,
                'price' => 99000,
                'discount' => 0.20,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 11,
                'category_id' => 3,
                'vendor_id' => 4,
                'name' => 'Giỏ Trái Cây Tài Lộc - Phú Quý',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea056b7e7b.webp"]',
                'unit' => 'giỏ',
                'quantity' => 1.00,
                'price' => 396000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 12,
                'category_id' => 3,
                'vendor_id' => 4,
                'name' => 'Giỏ Trái Cây Nhập Tông Hồng Hoạ Tiết Vàng',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea068a591f.webp"]',
                'unit' => 'giỏ',
                'quantity' => 1.00,
                'price' => 700000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 14,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => 'Dâu Hàn Quốc',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea09ad4159.webp", "products/668ea09bc7b1f.webp", "products/668ea09c381c2.webp"]',
                'unit' => 'kg',
                'quantity' => 7.90,
                'price' => 229000,
                'discount' => 0.15,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 15,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => 'Quýt nội địa Trung',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea0b5cc293.webp", "products/668ea0b69b379.webp", "products/668ea0b704749.webp"]',
                'unit' => 'kg',
                'quantity' => 5.40,
                'price' => 89000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 16,
                'category_id' => 2,
                'vendor_id' => 3,
                'name' => 'Vải trứng Daklak có cành',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea0e352590.webp"]',
                'unit' => 'kg',
                'quantity' => 7.40,
                'price' => 129000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 17,
                'category_id' => 2,
                'vendor_id' => 3,
                'name' => 'Sầu riêng cơm Musang King Việt Nam',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea115aa310.webp"]',
                'unit' => 'kg',
                'quantity' => 6.30,
                'price' => 318750,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 18,
                'category_id' => 2,
                'vendor_id' => 3,
                'name' => 'Mận xanh Tam Hoa',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea147b6f06.webp"]',
                'unit' => 'kg',
                'quantity' => 7.60,
                'price' => 89000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 19,
                'category_id' => 1,
                'vendor_id' => 4,
                'name' => 'Nho đỏ Long Crimson Úc',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea16425229.webp", "products/668ea16493c6e.webp", "products/668ea164ce8ce.webp"]',
                'unit' => 'kg',
                'quantity' => 8.90,
                'price' => 104500,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 20,
                'category_id' => 2,
                'vendor_id' => 5,
                'name' => 'Dưa lưới TL3',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea20a0f31d.webp"]',
                'unit' => 'kg',
                'quantity' => 7.50,
                'price' => 210000,
                'discount' => 0.22,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 21,
                'category_id' => 2,
                'vendor_id' => 6,
                'name' => 'Ổi nữ hoàng',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea2272fb65.webp"]',
                'unit' => 'kg',
                'quantity' => 8.00,
                'price' => 45000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 22,
                'category_id' => 2,
                'vendor_id' => 6,
                'name' => 'Xoài cát hòa lộc',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea26051105.webp"]',
                'unit' => 'kg',
                'quantity' => 5.50,
                'price' => 149000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 23,
                'category_id' => 2,
                'vendor_id' => 6,
                'name' => 'Bơ sáp',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea27bea3b4.webp"]',
                'unit' => 'kg',
                'quantity' => 8.20,
                'price' => 99000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 24,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => 'Việt quất Mỹ',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea2a05c15b.webp", "products/668ea2a0c2afb.webp", "products/668ea2a108cbf.webp"]',
                'unit' => 'kg',
                'quantity' => 9.70,
                'price' => 278000,
                'discount' => 0.20,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 25,
                'category_id' => 2,
                'vendor_id' => 6,
                'name' => 'Dưa hấu đỏ không hạt',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea2b9ef873.webp"]',
                'unit' => 'kg',
                'quantity' => 3.90,
                'price' => 156000,
                'discount' => 0.12,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 26,
                'category_id' => 2,
                'vendor_id' => 4,
                'name' => 'Đu đủ',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea2d8a65bd.webp"]',
                'unit' => 'kg',
                'quantity' => 10.00,
                'price' => 43500,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 27,
                'category_id' => 2,
                'vendor_id' => 4,
                'name' => 'Mận đỏ An Phước',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea2f5cc6f0.webp", "products/668ea2f6320bd.webp", "products/668ea2f667418.webp"]',
                'unit' => 'kg',
                'quantity' => 8.80,
                'price' => 78000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 28,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => 'Măng cụt Thái Lan',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea3123241b.webp", "products/668ea312e7e2b.webp", "products/668ea31324142.webp"]',
                'unit' => 'kg',
                'quantity' => 8.50,
                'price' => 59500,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 29,
                'category_id' => 2,
                'vendor_id' => 5,
                'name' => 'Chuối Dole 3 trái',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea32a6043a.webp"]',
                'unit' => 'kg',
                'quantity' => 5.40,
                'price' => 29000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 30,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => 'Lựu đỏ Peru',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea37be52eb.webp", "products/668ea37c6d74d.webp", "products/668ea37c9f1f5.webp"]',
                'unit' => 'kg',
                'quantity' => 8.30,
                'price' => 254250,
                'discount' => 0.18,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 31,
                'category_id' => 2,
                'vendor_id' => 6,
                'name' => 'Thanh long ruột đỏ',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea3a5cbe0e.webp"]',
                'unit' => 'kg',
                'quantity' => 8.60,
                'price' => 89000,
                'discount' => 0.20,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 32,
                'category_id' => 2,
                'vendor_id' => 4,
                'name' => 'Bưởi đường lá cam Tân Triều',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea3bdcacd4.webp", "products/668ea3be24264.webp", "products/668ea3be41dc2.webp"]',
                'unit' => 'kg',
                'quantity' => 5.50,
                'price' => 37000,
                'discount' => 0.00,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 33,
                'category_id' => 2,
                'vendor_id' => 3,
                'name' => 'Đu đủ ruột đỏ giống Đài Loan',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea42e832c8.webp"]',
                'unit' => 'kg',
                'quantity' => 8.60,
                'price' => 45000,
                'discount' => 0.25,
                'status' => 'Còn hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 34,
                'category_id' => 3,
                'vendor_id' => 5,
                'name' => 'Giỏ Trái Cây Nhập Healthy Living',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea45dc128d.webp"]',
                'unit' => 'giỏ',
                'quantity' => 0.00,
                'price' => 1200000,
                'discount' => 0.00,
                'status' => 'Tạm hết hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 35,
                'category_id' => 3,
                'vendor_id' => 5,
                'name' => 'Hộp Quà Trái Cây Nhập Màu Hồng Hoạ Tiết Vàng',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea4765ec59.webp"]',
                'unit' => 'giỏ',
                'quantity' => 0.00,
                'price' => 1100000,
                'discount' => 0.00,
                'status' => 'Tạm hết hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 36,
                'category_id' => 3,
                'vendor_id' => 5,
                'name' => 'Giỏ Trái Cây Nhập Lục Bình',
                'description' => "Trái cây tươi ngon",
                'images' => '["products/668ea4956c4d3.webp", "products/668ea495ededf.webp"]',
                'unit' => 'giỏ',
                'quantity' => 0.00,
                'price' => 1700000,
                'discount' => 0.00,
                'status' => 'Tạm hết hàng',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}

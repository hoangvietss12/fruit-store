<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class HomeController extends Controller
{
    public function index() {
        try {
            $data = Product::take(6)->get();

            $this->createUrlImages($data);

            return view('home.userhome', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function about() {
        try {
            return view('home.about');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function contact() {
        try {
            return view('home.contact');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function history() {

            $user_id = Auth::user()->id;

            $orders = DB::table('orders')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->where('orders.user_id', $user_id)
                ->where('orders.status', 'Đã xác nhận')
                ->select(
                    'orders.created_at',
                    'orders.order_type',
                    'order_details.price as order_detail_price',
                    'order_details.quantity as order_detail_quantity',
                    'order_details.total_price as order_detail_total_price',
                    'products.id as product_id',
                    'products.name as product_name',
                    'products.images as product_images'
                )
                ->orderBy('orders.created_at')
                ->get();

            $orders_array = $orders->toArray();

            // Tạo mảng kết quả nhóm theo `created_at`
            $group_orders = [];

            foreach ($orders_array as $order) {
                $created_at = $order->created_at;

                if (!isset($groupedOrders[$created_at])) {
                    $group_orders[$created_at] = [
                        'order_date' => $order->created_at,
                        'order_type' => $order->order_type,
                        'order_details' => []
                    ];
                }

                $group_orders[$created_at]['order_details'][] = [
                    'order_detail_price' => $order->order_detail_price,
                    'order_detail_quantity' => $order->order_detail_quantity,
                    'order_detail_total_price' => $order->order_detail_total_price,
                    'product_id' => $order->product_id,
                    'product_name' => $order->product_name,
                    'product_images' => $order->product_images,
                ];
            }

            foreach ($group_orders as &$order) {
                foreach ($order['order_details'] as &$data) {
                    $new_image_url = $this->createUrlImage($data['product_images']);
                    $data['product_images'] = $new_image_url;
                }
            }

            return view('home.history', compact('group_orders'));

    }

    public function loadMoreProducts(Request $request) {
        try {
            $offset = $request->input('offset', 0);
            $limit = 6;

            $products = Product::skip($offset)->take($limit)->get();

            $this->createUrlImages($products);

            return response()->json($products);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    private function createUrlImages($data) {
        try {
            $bucket = app('firebase.storage')->getBucket('fruit-ya.appspot.com');
            foreach ($data as $product) {
                $images = json_decode($product->images, true);
                $imageReference = $bucket->object($images[0]);

                if ($imageReference->exists()) {
                    $expiresAt = new \DateTime('tomorrow');
                    $imageUrl = $imageReference->signedUrl($expiresAt);
                }

                $product->images = $imageUrl;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    private function createUrlImage($data) {
        try {
            $bucket = app('firebase.storage')->getBucket('fruit-ya.appspot.com');
                $imageUrls = [];
                $images = json_decode($data, true);
                $imageReference = $bucket->object($images[0]);

                if ($imageReference->exists()) {
                    $expiresAt = new \DateTime('tomorrow');
                    $imageUrls[] = $imageReference->signedUrl($expiresAt);
                }

                return $imageUrls;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }
}

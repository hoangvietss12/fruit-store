<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartDetail;

class PurchaseController extends Controller
{
    public function index() {
        try {
            $user_id = Auth::user()->id;

            $user_cart = Cart::where('user_id', $user_id)->first();

            if(!$user_cart) {
                $new_cart = new Cart();
                $new_cart->user_id = $user_id;
                $new_cart->save();

                $user_cart = $new_cart;
            }

            $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();

            $total_price = 0;

            foreach ($data as $product){
                $total_price += $product->price * $product->quantity;
            }

            $this->createUrlImages($data);
            $check_order = $this->checkOrder();
            $check_order_type = $this->checkOrderType();

            return view('home.purchase', compact('data', 'total_price', 'check_order', 'check_order_type'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function checkout(Request $request) {
        try {
            $user_id = Auth::user()->id;
            $user_cart = Cart::where('user_id', $user_id)->first();
            $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();

            // calculate total price
            $total_price = 0;

            foreach ($data as $product){
                $total_price += $product->price * $product->quantity;
            }

            // create order
            $new_order = new Order();
            $new_order->user_id = $user_id;
            $new_order->order_type = $request->order_type;
            if($request->order_type == "Ship tận nơi"){
                $new_order->total = $total_price + 15000;
            }else {
                $new_order->total = $total_price;
            }
            $new_order->save();

            // create order detail
            $order_id = Order::where('user_id', $user_id)->first();
            foreach($data as $item) {
                $new_order_detail = new OrderDetail();

                $new_order_detail->order_id = $order_id->id;
                $new_order_detail->product_id = $item->product->id;
                $new_order_detail->quantity = $item->quantity;
                $new_order_detail->price = $item->product->price;
                $new_order_detail->total_price = $item->price * $item->quantity;

                $new_order_detail->save();
            }

            return back()->with('message', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function cancel() {
        try {
            $user_id = Auth::user()->id;
            $user_order = Order::where('user_id', $user_id)->where('status', "Chờ xác nhận")->first();

            $user_order->delete();

            return back()->with('message', 'Hủy đặt hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function createUrlImages($data) {
        $bucket = app('firebase.storage')->getBucket('fruit-ya-store-6573c.appspot.com');
        foreach ($data as $product) {
            $imageUrls = [];
            $images = json_decode($product->product->images, true);
            $imageReference = $bucket->object($images[0]);

            if ($imageReference->exists()) {
                $expiresAt = new \DateTime('tomorrow');
                $imageUrls[] = $imageReference->signedUrl($expiresAt);
            }

            $product->product->images = $imageUrls;
        }
    }

    public function checkOrder() {
        $user_id = Auth::user()->id;
        $user_order = Order::where('user_id', $user_id)->where('status', "Chờ xác nhận")->first();

        if($user_order){
            return true;
        }else {
            return false;
        }
    }

    public function checkOrderType() {
        $user_id = Auth::user()->id;
        $user_order = Order::where('user_id', $user_id)->where('order_type', "Ship tận nơi")->first();

        if($user_order){
            return true;
        }else {
            return false;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\CartDetail;

class PurchaseController extends Controller
{
    private function validator(array $data) {
        return Validator::make($data, [
            'product_quantity.*' => 'required|numeric|gt:0'
        ]);
    }
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

            $order_status = Order::where('user_id', $user_id)->where('status', 'Đang giao hàng')->first();

            $total_price = $this->sumTotal($data);

            $this->createUrlImages($data);
            $check_order = $this->checkOrder();
            $check_order_type = $this->checkOrderType();

            return view('home.purchase', compact('data', 'total_price', 'check_order', 'check_order_type', 'order_status'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function orderFromCart(Request $request) {
        try {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()->back()->with('message', 'Vui lòng nhập giá trị thỏa mãn!');
            }

            $user_id = Auth::user()->id;

            $user_cart = Cart::where('user_id', $user_id)->first();

            $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();

            $has_order = $this->checkOrder() ? true : false;
            $message = '';

            if($has_order) {
                $message = "Bạn phải hủy đặt hàng trước đã!";
            }else {
                $quantity = $request->all();
                $key = 0;
                foreach ($data as $cart_detail) {
                    $product_quantity = floatval($quantity['product_quantity'][$key]);

                    if ($cart_detail->quantity != $product_quantity) {
                        if($product_quantity > $cart_detail->product->quantity) {
                            return redirect()->back()->with('message', 'Vượt quá sản phẩm hiện có');
                        }

                        if($cart_detail->product->unit != "kg" && floor($product_quantity) != $product_quantity) {
                            return redirect()->back()->with('message', 'Vui lòng nhập giá trị thỏa mãn!');
                        }

                        $new_quantity = floatval($quantity['product_quantity'][$key]);
                        CartDetail::where('cart_id', $user_cart->id)
                                    ->where('product_id', $cart_detail->product->id)
                                    ->update(['quantity' => $new_quantity]);
                    }

                    $key++;
                }

                $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();
            }

            $total_price = $this->sumTotal($data);

            $this->createUrlImages($data);
            $order_status = Order::where('user_id', $user_id)->where('status', 'Đang giao hàng')->first();
            $check_order = $this->checkOrder();
            $check_order_type = $this->checkOrderType();

            session()->flash('message', $message);
            return view('home.purchase', compact('data', 'total_price', 'check_order', 'check_order_type', 'order_status'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function checkout(Request $request) {
        try {
            $user_id = Auth::user()->id;
            $user_cart = Cart::where('user_id', $user_id)->first();
            $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();

            // calculate total price
            $total_price = $this->sumTotal($data);

            // create order
            $new_order = new Order();
            $new_order->user_id = $user_id;
            $new_order->order_type = $request->order_type;
            if($request->order_type == "Ship tận nơi"){
                $new_order->total = $total_price + 15000;
            }else {
                $new_order->total = $total_price;
            }
            $new_order->created_at = Carbon::now('Asia/Bangkok');
            $new_order->save();

            // create order detail
            $order_id = Order::where('user_id', $user_id)->where('status', '=', 'Chờ xác nhận')->first();
            foreach($data as $item) {
                $new_order_detail = new OrderDetail();

                $new_order_detail->order_id = $order_id->id;
                $new_order_detail->product_id = $item->product->id;
                $new_order_detail->quantity = $item->quantity;
                if($item->product->discount > 0) {
                    $new_order_detail->price = $item->product->price - ($item->product->price * $item->product->discount);
                }else {
                    $new_order_detail->price = $item->product->price;
                }
                $new_order_detail->total_price = $new_order_detail->price * $item->quantity;
                $new_order_detail->created_at = Carbon::now('Asia/Bangkok');

                $new_order_detail->save();
            }

            return redirect('purchase')->with('message', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function cancel() {
        try {
            $user_id = Auth::user()->id;
            $user_order = Order::where('user_id', $user_id)
                                ->where('status', "Chờ xác nhận")
                                ->orWhere('status', "Đang giao hàng")
                                ->first();

            if($user_order) {
                $user_order->delete();
                $message = 'Hủy đặt hàng thành công!';
            }else {
                $message = 'Đơn hàng đã được giao đến!';
            }

            session()->flash('message', $message);
            return redirect('purchase');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    private function createUrlImages($data) {
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

    private function sumTotal($data) {
        $total_price = 0;

        foreach ($data as $product){
            if($product->product->discount > 0) {
                $total_price += ($product->price - ($product->price * $product->product->discount)) * $product->quantity;
            }else {
                $total_price += $product->price * $product->quantity;
            }
        }

        return $total_price;
    }

    private function checkOrder() {
        $user_id = Auth::user()->id;
        $user_order = Order::where('user_id', $user_id)
                            ->where('status', "Chờ xác nhận")
                            ->orWhere('status', "Đang giao hàng")
                            ->first();

        if($user_order){
            return true;
        }else {
            return false;
        }
    }

    private function checkOrderType() {
        $user_id = Auth::user()->id;
        $user_order = Order::where('user_id', $user_id)->where('order_type', "Ship tận nơi")->first();

        if($user_order){
            return true;
        }else {
            return false;
        }
    }
}

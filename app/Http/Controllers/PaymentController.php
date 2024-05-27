<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;

class PaymentController extends Controller
{
    private function generateRandomString($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $charLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
        return $randomString;
    }
    public function index(Request $request) {
        $vnp_Url = env('VNPAY_URL');
        $vnp_Returnurl = env('VNPAY_RETURN_URL');
        $vnp_TmnCode = env('VNPAY_MERCHANT_ID');
        $vnp_HashSecret = env('VNPAY_SECRET_KEY');

        $user_id = Auth::user()->id;
        $user_cart = Cart::where('user_id', $user_id)->first();
        $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();

        // calculate total price
        $total_price = 0;

        foreach ($data as $product){
            $total_price += $product->price * $product->quantity;
        }

        $vnp_TxnRef = $this->generateRandomString(5);
        $vnp_OrderInfo = 'Thanh toán VN Pay';
        $vnp_OrderType = 'Thanh toán VN Pay';
        $vnp_Amount = $total_price * 100;
        $vnp_Locale = 'Vi';
        $vnp_BankCode = $request->input('bank_code');
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }

    }

    public function purchaseReturn(Request $request) {
        try {
            $vnp_ResponseCode = $request->input('vnp_ResponseCode');

            $user_id = Auth::user()->id;
            $user_cart = Cart::where('user_id', $user_id)->first();
            $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();
            $order_status = Order::where('user_id', $user_id)->where('status', 'Đang giao hàng')->first();

            $message = "Giao dịch đã bị hủy!";

            $total_price = 0;

            foreach ($data as $product){
                if($product->product->discount > 0) {
                    $total_price += ($product->price - ($product->price * $product->product->discount)) * $product->quantity;
                }else {
                    $total_price += $product->price * $product->quantity;
                }
            }

            if($vnp_ResponseCode == "00") {
                $pending_orders = Order::where('user_id', $user_id)->where('status', 'Chờ xác nhận')->get();

                if ($pending_orders->count() == 2) {
                    $second_order = $pending_orders->skip(1)->first();
                    $second_order->delete();
                }

                $this->createOrder($data, $user_id, $total_price);
                $message = "Đặt hàng thành công!";
            }

            $this->createUrlImages($data);
            $check_order = $this->checkOrder();
            $check_order_type = $this->checkOrderType();

            session()->flash('message', $message);
            return view('home.purchase', compact('data', 'total_price', 'check_order', 'check_order_type', 'order_status'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function createOrder($data, $user_id, $total_price) {
            // create order
            $new_order = new Order();
            $new_order->user_id = $user_id;
            $new_order->order_type = "Thanh toán VN Pay";
            $new_order->total = $total_price;
            $new_order->created_at = Carbon::now('Asia/Bangkok');
            $new_order->save();

            // create order detail
            $order_id = Order::where('user_id', $user_id)->first();
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

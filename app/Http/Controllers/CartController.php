<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;

class CartController extends Controller
{
    public function index(){
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

            $this->createUrlImages($data);

            return view('home.cart', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function addToCart($id, Request $request){
        try {
            $new_quantity = floatval($request->product_quantity) ?? null;

            $user_id = Auth::user()->id;

            $user_cart = Cart::where('user_id', $user_id)->first();

            if(!$user_cart) {
                $new_cart = new Cart();
                $new_cart->user_id = $user_id;
                $new_cart->save();

                $user_cart = $new_cart;
            }

            $product = Product::findOrFail($id);

            $product_cart_id = CartDetail::where('cart_id', $user_cart->id)
                ->where('product_id', $product->id)
                ->first();

            if(!$product_cart_id) {
                $new_product_cart = new CartDetail();
                $new_product_cart->cart_id = $user_cart->id;
                $new_product_cart->product_id = $product->id;
                $new_product_cart->price = $product->price;

                if($new_quantity) {
                    $new_product_cart->quantity = $new_quantity;
                }else {
                    $new_product_cart->quantity = 1;
                }

                $new_product_cart->save();
            }else {
                if($new_quantity) {
                    DB::table('cart_details')
                    ->where('cart_id', $user_cart->id)
                    ->where('product_id', $product->id)
                    ->update(['quantity' => $new_quantity]);
                }
            }

            $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();

            $this->createUrlImages($data);

            return view('home.cart', compact('data'))->with('message', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function removeFromCart($id) {
        try {
            $user_id = Auth::user()->id;

            $user_cart = Cart::where('user_id', $user_id)->first();

            CartDetail::where('cart_id', $user_cart->id)
            ->where('product_id', $id)
            ->delete();

            return redirect()->back()->with('message', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function searchCart(Request $request) {
        try {
            $user_id = Auth::user()->id;

            $user_cart = Cart::where('user_id', $user_id)->first();

            $data = CartDetail::where('cart_id', $user_cart->id)
                                ->whereHas('product', function ($query) use ($request) {
                                    $query->where('name', 'like', '%' . $request->product_name . '%');
                                })
                                ->with('product')
                                ->get();


            $this->createUrlImages($data);

            return view('home.cart', compact('data'));
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;

class CartController extends Controller
{
    public function index(){
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
    }

    public function addToCart(Request $request){
        $user_id = Auth::user()->id;

        $user_cart = Cart::where('user_id', $user_id)->first();

        $product = Product::find($request->product_id);

        $product_cart_id = CartDetail::where('cart_id', $user_cart->id)
            ->where('product_id', $product->id)
            ->first();

        if(!$product_cart_id) {
            $new_product_cart = new CartDetail();
            $new_product_cart->cart_id = $user_cart->id;
            $new_product_cart->product_id = $product->id;
            $new_product_cart->quantity = 1;
            $new_product_cart->price = $product->price;
            $new_product_cart->save();
        }


        $data = CartDetail::where('cart_id', $user_cart->id)->with('product')->get();

        $this->createUrlImages($data);

        return view('home.cart', compact('data'));
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
}

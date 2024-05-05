<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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

    public function createUrlImages($data) {
        try {
            $bucket = app('firebase.storage')->getBucket('fruit-ya-store-6573c.appspot.com');
            foreach ($data as $product) {
                $imageUrls = [];
                $images = json_decode($product->images, true);
                $imageReference = $bucket->object($images[0]);

                if ($imageReference->exists()) {
                    $expiresAt = new \DateTime('tomorrow');
                    $imageUrls[] = $imageReference->signedUrl($expiresAt);
                }

                $product->images = $imageUrls;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }
}

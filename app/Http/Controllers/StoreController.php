<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class StoreController extends Controller
{
    public function index() {
        try {
            $data = Product::paginate(9);
            $categories = Category::all();

            $this->createUrlImages($data);

            return view('home.store', compact('data', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function search(Request $request) {
        try {
            $data = Product::where('name', $request->product_name)->paginate(9);
            $categories = Category::all();

            $this->createUrlImages($data);

            return view('home.store', compact('data', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
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
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }
}

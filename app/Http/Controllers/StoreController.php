<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class StoreController extends Controller
{
    private $range_price = [
        '0-50000',
        '50001-100000',
        '100001-500000',
        '500001-1000000',
        '1000001-'
    ];
    public function index() {
        try {
            $data = Product::paginate(9);
            $categories = Category::all();

            $range_price = $this->range_price;
            $this->createUrlImages($data);

            return view('home.store', compact('data', 'categories', 'range_price'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function product($id) {
        try {
            $product = Product::with('category')->findOrFail($id);
            $title = $product->name;

            $this->createUrlImagesForProduct($product);

            $random_products = Product::inRandomOrder()->take(6)->get();

            $this->createUrlImages($random_products);

            return view('home.product-details', compact('product', 'title', 'random_products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function search(Request $request) {
        try {
            $data = Product::where('name', $request->product_name)->paginate(9);
            $categories = Category::all();

            $range_price = $this->range_price;
            $this->createUrlImages($data);

            return view('home.store', compact('data', 'categories', 'range_price'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function filter(Request $request) {
        try {
            $category_id = $request->input('product_category') ?? null;
            $price = $request->input('product_price') ?? null;
            $is_discount = $request->input('product_discount');
            $sort_price = $request->input('product_price_sort');

            $products = Product::query();

            if ($category_id != null) {
                $products->where('category_id', $category_id);
            }

            if ($price !=null ) {
                $price_range = explode('-', $price);
                $min_price = (int)$price_range[0];
                $max_price = (int)$price_range[1];
                $products->whereBetween('price', [$min_price, $max_price]);
            }

            if ($is_discount == 'true') {
                $products->where('discount', '>', 0.0);
            }

            if ($sort_price !=null) {
                $products->orderBy('price', $sort_price);
            }

            $data = $products->paginate(9);

            $categories = Category::all();
            $range_price = $this->range_price;
            $this->createUrlImages($data);

            return view('home.store', compact('data', 'categories', 'range_price'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    private function createUrlImages($data) {
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

    private function createUrlImagesForProduct($product) {
        $bucket = app('firebase.storage')->getBucket('fruit-ya-store-6573c.appspot.com');
        $imageUrls = [];
        $images = json_decode($product->images, true);

        foreach($images as $image) {
            $imageReference = $bucket->object($image);

            if ($imageReference->exists()) {
                $expiresAt = new \DateTime('tomorrow');
                $imageUrls[] = $imageReference->signedUrl($expiresAt);
            }
        }

        $product->images = $imageUrls;
    }
}

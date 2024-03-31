<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index() {
        $data = Product::take(6)->get();

        $this->createUrlImages($data);

        return view('home.userhome', compact('data'));
    }

    public function store() {
        $data = Product::paginate(9);
        $categories = Category::all();

        $this->createUrlImages($data);


        return view('home.store', compact('data', 'categories'));
    }

    public function loadMoreProducts(Request $request) {
        $offset = $request->input('offset', 0);
        $limit = 6;

        $products = Product::skip($offset)->take($limit)->get();

        $this->createUrlImages($products);

        return response()->json($products);
    }

    public function getProductsByCategory($category) {
        $category = Category::where('id', $category)->get();

        $data = Product::where('category', $category->category_name)->get();

        $this->createUrlImages($data);

        return response()->json($data);
    }

    public function createUrlImages($data) {
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
    }
}

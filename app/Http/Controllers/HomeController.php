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
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function about() {
        try {
            return view('home.about');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function contact() {
        try {
            return view('home.contact');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function store() {
        try {
            $data = Product::paginate(9);
            $categories = Category::all();

            $this->createUrlImages($data);

            return view('home.store', compact('data', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
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
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    // fix
    public function getProductsByCategory($category) {
        try {
            $category = Category::where('id', $category)->get();

            $data = Product::where('category', $category->category_name)->get();

            $this->createUrlImages($data);

            return response()->json($data);
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

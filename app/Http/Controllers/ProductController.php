<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ProductController extends Controller
{
    private $range_price = [
        '0-50000',
        '50001-100000',
        '100001-300000',
        '300001-500000',
        '500001-1000000',
        '1000001-'
    ];
    public function index() {
        try {
            $data = Product::paginate(8);
            $categories = Category::all();
            $vendors = Vendor::all();
            $range_price = $this->range_price;

            $this->createUrlImagesForProducts($data);

            return view('admin.products.index', compact('data', 'categories', 'vendors', 'range_price'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function create() {
        try {
            $categories = Category::all();
            $vendors = Vendor::all();

            return view('admin.products.add', compact('categories', 'vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function store(Request $request) {
        $data = new Product;
        $data->name = $request->product_name;
        $data->description = $request->product_description;
        $data->unit = $request->product_unit;
        $data->quantity = floatval($request->product_quantity);
        $data->price = intval($request->product_price);
        $data->discount = floatval($request->product_discount);
        $data->category_id = intval($request->input('product_category'));
        $data->vendor_id = intval($request->input('product_vendor'));

        $imageUrls = $this->uploadImagesToFirebase($request);

        $data->images = json_encode($imageUrls);

        $data->save();

        return redirect('fruitya-admin/product')->with('message', 'Thêm thành công!');
    }

    public function view($id) {
        try {
            $product = Product::where('id', $id)->with('category')->with('vendor')->first();

            $this->createUrlImagesForProduct($product);

            return view('admin.products.view', compact('product'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function edit($id) {
        try {
            $categories = Category::all();
            $vendors = Vendor::all();

            $data = Product::findOrFail($id);

            return view('admin.products.edit', compact('data', 'categories', 'vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id) {
        try {
            $data = Product::find($id);

            $quantity = floatval($request->quantity);
            $price = intval($request->price);
            $discount = floatval($request->discount);
            $category = $request->input('category');
            $vendor = $request->input('vendor');

            if($request->hasFile('images')) {
                $this->deleteImageFromFirebase($data->images);

                $imageUrls = $this->uploadImagesToFirebase($request);

                $images = json_encode($imageUrls);

                $data->update([ 'name' => $request->name,
                                'category_id' => $category,
                                'vendor_id' => $vendor,
                                'images' => $images,
                                'description' => $request->description,
                                'quantity' => $quantity,
                                'unit' => $request->unit,
                                'price' => $price,
                                'discount' => $discount,
                                'status' => $request->status
                            ]);
            }else {
                $data->update([ 'name' => $request->name,
                                'category' => $category,
                                'vendor_id' => $vendor,
                                'description' => $request->description,
                                'quantity' => $request->quantity,
                                'unit' => $request->unit,
                                'price' => $price,
                                'discount' => $discount
                            ]);
            }

            return redirect('fruitya-admin/product')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $data = Product::find($id);

            $this->deleteImageFromFirebase($data->images);

            $data->delete();

            return redirect()->back()->with('message', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function search(Request $request) {
        try {
            $name = $request->has('product_name') ? $request->product_name : null;
            $category = $request->has('product_category') ? $request->input('product_category') : null;
            $vendor = $request->has('product_vendor') ? $request->input('product_vendor') : null;
            $price = $request->has('product_price') ? $request->input('product_price') : null;
            $discount = $request->has('product_discount') ? $request->input('product_discount') : null;
            $status = $request->has('product_status') ? $request->input('product_status') : null;

            $query = Product::query();

            if ($name !== null) {
                $query->where('name', 'like', '%'.$name.'%');
            }

            if ($category !== null) {
                $query->where('category_id', '=', $category);
            }

            if ($vendor !== null) {
                $query->where('vendor_id', '=', $vendor);
            }

            if ($price !=null ) {
                $price_range = explode('-', $price);
                $min_price = (int)$price_range[0];
                $max_price = (int)$price_range[1];
                $query->whereBetween('price', [$min_price, $max_price]);
            }

            if ($discount == 'true') {
                $query->where('discount', '>', 0.0);
            }else if($discount == 'false') {
                $query->where('discount', '=', 0.0);
            }

            if ($discount == 'Còn hàng') {
                $query->where('status', '=', 'Còn hàng');
            }else if($discount == 'hết hàng') {
                $query->where('status', '=', 'Hết hàng');
            }

            $data = $query->paginate(8);
            $categories = Category::all();
            $vendors = Vendor::all();
            $range_price = $this->range_price;

            $this->createUrlImagesForProducts($data);

            return view('admin.products.index', compact('data', 'categories', 'vendors', 'range_price'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function createUrlImagesForProducts($data) {
        $bucket = app('firebase.storage')->getBucket('fruit-ya-store-6573c.appspot.com');
        foreach ($data as $product) {
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

    public function createUrlImagesForProduct($product) {
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

    private function uploadImagesToFirebase($request) {
        $imageUrls = [];

        if($request->hasFile('images')) {
            $firebaseStorage = app('firebase.storage');
            $bucket = $firebaseStorage->getBucket('fruit-ya-store-6573c.appspot.com');

            foreach($request->file('images') as $image) {
                $imageUrl = 'products/' . uniqid() . '.' . $image->getClientOriginalExtension();

                $bucket->upload($image->getContent(), [
                    'name' => $imageUrl,
                ]);

                $imageUrls[] = $imageUrl;
            }
        }

        return $imageUrls;
    }

    private function deleteImageFromFirebase($imagePaths) {
        $firebaseStorage = app('firebase.storage');
        $bucket = $firebaseStorage->getBucket('fruit-ya-store-6573c.appspot.com');

        $imagePaths = json_decode($imagePaths, true);
        foreach ($imagePaths as $imageUrl) {
            $object = $bucket->object($imageUrl);
            $object->delete();
        }
    }
}

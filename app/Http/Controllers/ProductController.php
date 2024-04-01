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
    public function index() {
        $data = Product::paginate(8);

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

        return view('admin.products.index', compact('data'));
    }

    public function create() {
        $categories = Category::all();
        $vendors = Vendor::all();

        return view('admin.products.add', compact('categories', 'vendors'));
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
        $product = Product::where('id', $id)->with('category')->with('vendor')->first();

        $this->createUrlImages($product);

        return view('admin.products.view', compact('product'));
    }

    public function edit($id) {
        $categories = Category::all();
        $vendors = Vendor::all();

        $data = Product::findOrFail($id);

        return view('admin.products.edit', compact('data', 'categories', 'vendors'));
    }

    public function update(Request $request, $id) {
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
    }

    public function delete($id) {
        $data = Product::find($id);

        $this->deleteImageFromFirebase($data->images);

        $data->delete();

        return redirect()->back()->with('message', 'Xóa thành công!');
    }

    public function createUrlImages($product) {
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

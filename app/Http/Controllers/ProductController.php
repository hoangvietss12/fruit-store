<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    private function validator(array $data)
    {
        return Validator::make($data, [
            'product_name' => 'required|string',
            'product_category' => 'required',
            'product_vendor' => 'required',
            'product_unit' => 'required|string',
            'product_quantity' => ['required', 'string', 'regex:/^[0-9.]+$/', 'min:1'],
            'product_price' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:0'],
            'product_discount' => ['required', 'numeric', 'between:0,1'],
            'product_description' => 'required|string',
            // 'product_images' => 'required|array',
            // 'product_images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ],[
            'product_name.required' => 'Tên sản phẩm là trường bắt buộc.',
            'product_category.required' => 'Danh mục của sản phẩm là trường bắt buộc.',
            'product_vendor.email' => 'Nhà cung cấp của sản phẩm phải là trường bắt buộc.',
            'product_unit.required' => 'Đơn vị tính là trường bắt buộc.',
            'product_quantity.required' => 'Số lượng sản phẩm là trường bắt buộc.',
            'product_quantity.regex' => 'Số lượng sản phẩm phải là số.',
            'product_quantity.min' => 'Số lượng sản phẩm phải lớn hơn 1.',
            'product_price.required' => 'Giá của sản phẩm là trường bắt buộc.',
            'product_price.regex' => 'Giá của sản phẩm phải là số.',
            'product_price.min' => 'Giá của sản phẩm phải lớn hơn 0.',
            'product_discount.required' => 'Giảm giá của sản phẩm là trường bắt buộc.',
            'product_discount.numeric' => 'Giảm giá của sản phẩm phải là số.',
            'product_discount.between' => 'Giảm giá của sản phẩm phải là từ 0 đến 1.',
            'product_description.required' => 'Mô tả sản phẩm là trường bắt buộc.',
            'product_images.required' => 'Ảnh sản phẩm là trường bắt buộc.',
            // 'product_images.image' => 'Tệp phải là một hình ảnh.',
            // 'product_images.mimes' => 'Ảnh sản phẩm phải có định dạng jpeg, png, jpg, webp hoặc gif.',
            // 'product_images.max' => 'Dung lượng ảnh sản phẩm không được vượt quá 1MB.'
        ]);
    }
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
        try {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
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
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = Product::find($id);

            $quantity = floatval($request->product_quantity);
            $price = intval($request->product_price);
            $discount = floatval($request->product_discount);
            $category = $request->input('product_category');
            $vendor = $request->input('product_vendor');

            if($request->hasFile('product_images')) {
                $this->deleteImageFromFirebase($data->images);

                $imageUrls = $this->uploadImagesToFirebase($request);

                $images = json_encode($imageUrls);

                $data->update([ 'name' => $request->product_name,
                                'category_id' => $category,
                                'vendor_id' => $vendor,
                                'images' => $images,
                                'description' => $request->product_description,
                                'quantity' => $quantity,
                                'unit' => $request->product_unit,
                                'price' => $price,
                                'discount' => $discount,
                                'status' => $request->product_status
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
            $name = $request->product_name;
            $category =$request->input('product_category');
            $vendor = $request->input('product_vendor');
            $price = $request->input('product_price');
            $discount = $request->input('product_discount');
            $status = $request->input('product_status');

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

            $price = $request->input('product_price');
            if ($price !== null) {
                $price_range = explode('-', $price);
                $min_price = (int)$price_range[0];
                $max_price = isset($price_range[1]) ? (int)$price_range[1] : PHP_INT_MAX;
                $query->whereBetween('price', [$min_price, $max_price]);
            }


            if ($discount == 'true') {
                $query->where('discount', '>', 0.0);
            } else if ($discount == 'false') {
                $query->where('discount', '=', 0.0);
            }

            if ($status == 'Còn hàng') {
                $query->where('status', '=', 'Còn hàng');
            } else if ($status == 'Hết hàng') {
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

        // Kiểm tra xem request có chứa file ảnh không
        if ($request->hasFile('product_images')) {
            // Lấy danh sách các file ảnh từ request
            $images = $request->file('product_images');

            // Tạo đường dẫn lưu trữ trên Firebase Storage cho mỗi file ảnh
            foreach ($images as $image) {
                // Tạo đường dẫn lưu trữ trên Firebase Storage cho mỗi file ảnh
                $firebaseStorage = app('firebase.storage');
                $bucket = $firebaseStorage->getBucket('fruit-ya-store-6573c.appspot.com');
                $imageUrl = 'products/' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Upload file ảnh lên Firebase Storage
                $bucket->upload($image->getContent(), [
                    'name' => $imageUrl,
                ]);

                // Thêm URL của file ảnh vào mảng
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

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Exports\ProductExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    private $range_price = [
        '0-50000',
        '50001-100000',
        '100001-300000',
        '300001-500000',
        '500001-1000000',
        '1000001-'
    ];

    public function indexProduct() {
        $categories = Category::all();
        $vendors = Vendor::all();
        $range_price = $this->range_price;

        return view('admin.reports.product', compact('categories', 'vendors', 'range_price'));
    }

    public function searchProduct(Request $request) {

        $category = $request->input('product_category') ?? null;
        $vendor = $request->input('product_vendor') ?? null;
        $price = $request->input('product_price') ?? null;
        $is_discount = $request->input('product_discount');

        $params = [
            'category' => $category,
            'vendor' => $vendor,
            'price' => $price,
            'discount' => $is_discount
        ];
        dd($params);

        $data = $this->queryProducts($category, $vendor, $price, $is_discount);

        $categories = Category::all();
        $vendors = Vendor::all();
        $range_price = $this->range_price;

        return view('admin.reports.product', compact('data', 'categories', 'vendors', 'range_price', 'is_discount', 'params'));
    }

    public function exportProduct($categoryId = null, $vendorId = null, $price = null) {
        $data = $this->queryProducts($categoryId, $vendorId, $price);

        $today_date = Carbon::now()->format('d/m/Y');
        return Excel::download(new ProductExport($data), 'data_'.$today_date.'.xlsx');
    }

    public function queryProducts($categoryId, $vendorId, $price, $discount = null) {
        $products = Product::query();

        if ($categoryId != null) {
            $products->where('category_id', $categoryId);
        }

        if ($vendorId != null) {
            $products->where('vendor_id', $vendorId);
        }

        if ($price !=null ) {
            $priceRange = explode('-', $price);
            $minPrice = (int)$priceRange[0];
            $maxPrice = (int)$priceRange[1];
            $products->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if ($discount == 'true') {
            $products->where('discount', '>', 0.0);
        }

        $data = $products->with('vendor')->with('category')->get();

        return $data;
    }
}
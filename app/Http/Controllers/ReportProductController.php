<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Exports\ProductExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportProductController extends Controller
{
    public function indexProduct() {
        try {
            $categories = Category::all();
            $vendors = Vendor::all();

            return view('admin.reports.product', compact('categories', 'vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function searchProduct(Request $request) {
        try {
            $category = $request->input('product_category') ?? 'all';
            $vendor = $request->input('product_vendor') ?? 'all';
            $date_start = $request->input('date_start') ?? 'all';
            $date_end = $request->input('date_end') ?? 'all';

            $params = [
                'category' => $category,
                'vendor' => $vendor,
                'start' => $date_start,
                'end' => $date_end
            ];

            $data = $this->queryProducts($category, $vendor, $date_start, $date_end);

            $categories = Category::all();
            $vendors = Vendor::all();

            return view('admin.reports.product', compact('data', 'categories', 'vendors', 'params'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function exportProduct($categoryId, $vendorId, $start, $end) {
        try {
            $data = $this->queryProducts($categoryId, $vendorId, $start, $end);

            $file_name = "products.xlsx";

            return Excel::download(new ProductExport($data, $start, $end), $file_name);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function queryProducts($categoryId, $vendorId, $date_start, $date_end) {
        $products = Product::query();

        if ($categoryId != 'all' ) {
            $products->where('category_id', $categoryId);
        }

        if ($vendorId != 'all') {
            $products->where('vendor_id', $vendorId);
        }

        if($date_start != 'all' && $date_end != 'all') {
            $start = Carbon::createFromFormat('Y-m-d', $date_start)->startOfDay();
            $end = Carbon::createFromFormat('Y-m-d', $date_end)->endOfDay();

            $data = $products->with(['vendor', 'category', 'goodsReceivedNoteDetails' => function($query) use ($start, $end) {
                                $query->whereBetween('created_at', [$start, $end]);
                            }, 'orderDetails' => function($query) use ($start, $end) {
                                $query->whereBetween('created_at', [$start, $end]);
                            }])
                            ->get();
        }else if($date_start != 'all') {
            $start = Carbon::createFromFormat('Y-m-d', $date_start)->startOfDay();

            $data = $products->with(['vendor', 'category', 'goodsReceivedNoteDetails' => function($query) use ($start) {
                        $query->where('created_at', '>=', $start);
                    }, 'orderDetails' => function($query) use ($start) {
                        $query->where('created_at', '>=', $start);
                    }])
                    ->get();
        }else if($date_end != 'all') {
            $end = Carbon::createFromFormat('Y-m-d', $date_end)->endOfDay();

            $data = $products->with(['vendor', 'category', 'goodsReceivedNoteDetails' => function($query) use ($end) {
                                $query->where('created_at', '<=', $end);
                            }, 'orderDetails' => function($query) use ($end) {
                                $query->where('created_at', '<=', $end);
                            }])
                            ->get();
        }else {
            $data = $products->with(['vendor', 'category', 'goodsReceivedNoteDetails', 'orderDetails'])->get();
        }

        return $data;
    }
}

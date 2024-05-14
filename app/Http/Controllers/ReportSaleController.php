<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Exports\SaleExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportSaleController extends Controller
{
    public function indexSale() {
        try {
            $categories = Category::all();
            $vendors = Vendor::all();

            return view('admin.reports.sale', compact('categories', 'vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function searchSale(Request $request) {
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

            $data = $this->querySales($category, $vendor, $date_start, $date_end);

            $categories = Category::all();
            $vendors = Vendor::all();

            return view('admin.reports.sale', compact('data', 'categories', 'vendors', 'params'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function exportSale($categoryId, $vendorId, $start, $end) {
        try {
            $data = $this->querySales($categoryId, $vendorId, $start, $end);

            $file_name = "sales.xlsx";

            return Excel::download(new SaleExport($data, $start, $end), $file_name);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function querySales($categoryId, $vendorId, $date_start, $date_end) {
        $products = Product::query();

        if ($categoryId != 'all' ) {
            $products->where('category_id', $categoryId);
        }

        if ($vendorId != 'all') {
            $products->where('vendor_id', $vendorId);
        }

        $start = $date_start === 'all' ? $date_start : Carbon::createFromFormat('Y-m-d', $date_start)->startOfDay();
        $end = $date_end === 'all' ? $date_end : Carbon::createFromFormat('Y-m-d', $date_end)->endOfDay();

        if($date_start != 'all' && $date_end != 'all') {
            $data = $products->whereHas('orderDetails', function($query) use ($start, $end) {
                                    $query->whereBetween('created_at', [$start, $end]);
                                })->with(['vendor', 'category', 'orderDetails' => function($query) use ($start, $end) {
                                    $query->whereBetween('created_at', [$start, $end]);
                                }])
                                ->get();
        }else if($date_start != 'all') {
            $data = $products->whereHas('orderDetails', function($query) use ($start) {
                                    $query->where('created_at', '>=', $start);
                                })->with(['vendor', 'category', 'orderDetails' => function($query) use ($start) {
                                    $query->where('created_at', '>=', $start);
                                }])
                                ->get();
        }else if($date_end != 'all') {
            $data = $products->whereHas('orderDetails', function($query) use ($end) {
                                    $query->where('created_at', '<=', $end);
                                })->with(['vendor', 'category', 'orderDetails' => function($query) use ($end) {
                                    $query->where('created_at', '<=', $end);
                                }])
                                ->get();
        }else {
            $data = $products->whereHas('orderDetails')->with(['vendor', 'category', 'orderDetails'])->get();
        }

        return $data;
    }
}

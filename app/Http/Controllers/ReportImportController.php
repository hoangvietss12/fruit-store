<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Exports\ImportExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportImportController extends Controller
{
    public function indexImport() {
        try {
            $categories = Category::all();
            $vendors = Vendor::all();

            return view('admin.reports.import', compact('categories', 'vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function searchImport(Request $request) {
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

            $data = $this->queryImports($category, $vendor, $date_start, $date_end);

            $categories = Category::all();
            $vendors = Vendor::all();

            return view('admin.reports.import', compact('data', 'categories', 'vendors', 'params'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function exportImport($categoryId, $vendorId, $start, $end) {
        try {
            $data = $this->queryImports($categoryId, $vendorId, $start, $end);

            $file_name = "imports.xlsx";

            return Excel::download(new ImportExport($data, $start, $end), $file_name);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function queryImports($categoryId, $vendorId, $date_start, $date_end) {
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
            $data = $products->whereHas('goodsReceivedNoteDetails', function($query) use ($start, $end) {
                                    $query->whereBetween('created_at', [$start, $end]);
                                })
                                ->with(['vendor', 'category', 'goodsReceivedNoteDetails' => function($query) use ($start, $end) {
                                    $query->whereBetween('created_at', [$start, $end]);
                                }])
                                ->get();

        }else if($date_start != 'all') {
            $data = $products->whereHas('goodsReceivedNoteDetails', function($query) use ($start) {
                                    $query->where('created_at', '>=', $start);
                                })
                                ->with(['vendor', 'category', 'goodsReceivedNoteDetails' => function($query) use ($start) {
                                    $query->where('created_at', '>=', $start);
                                }])
                                ->get();
        }else if($date_end != 'all') {
            $data = $products->whereHas('goodsReceivedNoteDetails', function($query) use ($end) {
                                    $query->where('created_at', '<=', $end);
                                })->with(['vendor', 'category', 'goodsReceivedNoteDetails' => function($query) use ($end) {
                                    $query->where('created_at', '<=', $end);
                                }])
                                ->get();
        }else {
            $data = $products->whereHas('goodsReceivedNoteDetails')->with(['vendor', 'category', 'goodsReceivedNoteDetails'])->get();
        }

        return $data;
    }
}

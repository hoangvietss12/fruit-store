<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Exports\RevenueExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\GoodReceivedNote;

class ReportRevenueController extends Controller
{
    public function indexRevenue() {
        try {
            return view('admin.reports.revenue');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function searchRevenue(Request $request) {
        try {
            $date_start = $request->input('date_start') ?? 'all';
            $date_end = $request->input('date_end') ?? 'all';

            $params = [
                'start' => $date_start,
                'end' => $date_end
            ];

            $data = $this->queryRevenue($date_start, $date_end);

            return view('admin.reports.revenue', compact('data', 'params'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function exportRevenue($start, $end) {
        try {
            $data = $this->queryRevenue($start, $end);

            // $start = $start === 'all' ? Carbon::now()->format('d-m-Y') : Carbon::createFromFormat('d-m-Y', $start);
            // $end = $end === 'all' ? Carbon::now()->format('d-m-Y') : Carbon::createFromFormat('d-m-Y', $end);

            $file_name = "revenue.xlsx";

            return Excel::download(new RevenueExport($data, $start, $end), $file_name);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function queryRevenue($date_start, $date_end) {
        $sale_totals = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total_sale_price'))
                                ->groupBy(DB::raw('DATE(created_at)'));
        $import_totals = GoodReceivedNote::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total_import_price'))
                                ->groupBy(DB::raw('DATE(created_at)'));

        $start = $date_start === 'all' ? $date_start : Carbon::createFromFormat('Y-m-d', $date_start)->startOfDay();
        $end = $date_end === 'all' ? $date_end : Carbon::createFromFormat('Y-m-d', $date_end)->endOfDay();

        if($start != 'all' && $end != 'all') {
            $sale_totals->whereBetween('created_at', [$start, $end]);
            $import_totals->whereBetween('created_at', [$start, $end]);
        }else if($start != 'all') {
            $sale_totals->where('created_at', '>=', $start);
            $import_totals->where('created_at', '>=', $start);
        }else if($end != 'all') {
            $sale_totals->where('created_at', '<=', $end);
            $import_totals->where('created_at', '<=', $end);
        }

        // Create an empty collection
        $data = new Collection();

        // Retrieve and append results from the first query
        $sale_results = $sale_totals->get();
        $data = $data->concat($sale_results);

        // Retrieve and append results from the second query
        $import_results = $import_totals->get();
        $data = $data->concat($import_results);

        $data = $data->groupBy('date')->map(function ($item) {
            return [
                'date' => $item->first()['date'],
                'total_sale_price' => $item->sum('total_sale_price'),
                'total_import_price' => $item->sum('total_import_price')
            ];
        })->sortByDesc('date')->values();

        return $data;
    }
}

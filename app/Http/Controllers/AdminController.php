<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Session;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\GoodReceivednote;


class AdminController extends Controller
{
    public function index() {
        try {
            $data = $this->getCountData();

            $order_data = $this->getOrderData();

            $goods_received_note_data = $this->getGoodsReceivedNoteData();

            $revenue_data = $this->getRevenueData();

            return view('admin.dashboard', compact('data', 'order_data', 'goods_received_note_data', 'revenue_data'));
        }catch(\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function session() {
        try {
            $data = Session::with('user')->paginate(10);

            return view('admin.session', compact('data'));
        }catch(\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }
    private function getCountData() {
        $account_total = User::where('user_type', '!=', '1')->get()->count();
        $account_active = User::where('status', '=', 'active')->where('user_type', '!=', '1')->get()->count();
        $account_deactive = User::where('status', '=', 'deactive')->where('user_type', '!=', '1')->get()->count();

        $product_total = Product::get()->count();
        $product_active = Product::where('status', '=', 'Còn hàng')->get()->count();
        $product_deactive = Product::where('status', '=', 'Tạm hết hàng')->get()->count();

        $order_total = Order::get()->count();
        $order_active = Order::where('status', '=', 'Đã xác nhận')->get()->count();
        $order_deactive = Order::where('status', '=', 'Chờ xác nhận')->get()->count();

        return  [
            'account_total' => $account_total,
            'account_active' => $account_active,
            'account_deactive' => $account_deactive,
            'product_total' => $product_total,
            'product_active' => $product_active,
            'product_deactive' => $product_deactive,
            'order_total' => $order_total,
            'order_active' => $order_active,
            'order_deactive' => $order_deactive,
        ];
    }

    private function getRevenueData() {
        $current_date = Carbon::now()->subDays(1)->endOfDay();
        $seven_days_ago = Carbon::now()->subDays(7)->startOfDay();

        $total_order_data = Order::select(
                                DB::raw('DATE(created_at) as date'),
                                DB::raw('SUM(total) as total_sale_price')
                            )
                            ->whereBetween('created_at', [$seven_days_ago, $current_date])
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        $total_note_data = GoodReceivednote::select(
                                DB::raw('DATE(created_at) as date'),
                                DB::raw('SUM(total) as total_import_price')
                            )
                            ->whereBetween('created_at', [$seven_days_ago, $current_date])
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        $merger_data = new Collection();
        $merger_data = $merger_data->concat($total_order_data);
        $merger_data = $merger_data->concat($total_note_data);
        $merger_data = $merger_data->groupBy('date')->map(function ($item) {
            return [
                'date' => $item->first()['date'],
                'total_sale_price' => $item->sum('total_sale_price'),
                'total_import_price' => $item->sum('total_import_price')
            ];
        })->values();

        return $merger_data;
    }

    private function getOrderData() {
        $current_date = Carbon::now()->subDays(1)->endOfDay();
        $seven_days_ago = Carbon::now()->subDays(7)->startOfDay();

        $order_data = Order::select(
                            DB::raw('DATE(created_at) as order_date'),
                            DB::raw('COUNT(*) as total_orders')
                        )
                        ->whereBetween('created_at', [$seven_days_ago, $current_date])
                        ->groupBy('order_date')
                        ->orderBy('order_date')
                        ->get();

        return $order_data;
    }

    private function getGoodsReceivedNoteData() {
        $current_date = Carbon::now()->subDays(1)->endOfDay();
        $seven_days_ago = Carbon::now()->subDays(7)->startOfDay();

        $goods_received_note_data = GoodReceivednote::select(
                                        DB::raw('DATE(created_at) as date'),
                                        DB::raw('COUNT(*) as total')
                                    )
                                    ->whereBetween('created_at', [$seven_days_ago, $current_date])
                                    ->groupBy('date')
                                    ->orderBy('date')
                                    ->get();

        return $goods_received_note_data;
    }
}

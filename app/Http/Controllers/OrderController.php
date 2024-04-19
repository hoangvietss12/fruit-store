<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use PDF;

class OrderController extends Controller
{
    public function index() {
        try {
            $data = Order::with('user')->paginate(10);

            return view('admin.orders.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function view($id) {
        try {
            $order_info = Order::where('id', $id)->with('user')->first();

            $order_detail_info = OrderDetail::where('order_id', $order_info->id)->with('product')->get();

            if($order_info->order_type == 'Thanh toán VN Pay') {
                $order_detail_info = OrderDetail::where('order_id', $order_info->id)->with('product')->take(floor($order_detail_info->count() / 2))->get();
            }

            return view('admin.orders.view', compact('order_info', 'order_detail_info'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function edit($id) {
        try {
            $data = Order::findOrFail($id);

            return view('admin.orders.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id) {
        try {
            $status = $request->input('order_type');
            $order = Order::findOrNew($id);
            $order->status = $status;
            $order->save();

            if($status == "Đã xác nhận") {
                $cart_user = Cart::where('user_id', $order->user_id)->first();

                $cart_user->delete();
            }

            return redirect('fruitya-admin/order')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function print($id) {
        try {
            $order_info = Order::where('id', $id)->with('user')->first();

            $order_detail_info = OrderDetail::where('order_id', $order_info->id)->with('product')->get();
            if($order_info->order_type == 'Thanh toán VN Pay') {
                $order_detail_info = OrderDetail::where('order_id', $order_info->id)->with('product')->take(floor($order_detail_info->count() / 2))->get();
            }

            $pdf = PDF::loadView('admin.orders.view', compact('order_info', 'order_detail_info'));
            $today_date = Carbon::now()->format('d/m/Y');

            return $pdf->stream('invoice'.$id.'_'.$today_date.'.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function search(Request $request) {
        try {
            $user_name = $request->has('user_name') ? $request->user_name : null;
            $date_start = $request->has('date_start') ? $request->input('date_start') : null;
            $date_end = $request->has('date_end') ? $request->input('date_end') : null;

            $query = Order::query();

            if($date_start != null && $date_end != null) {
                $date_start_formatted = date("Y-m-d H:i:s", strtotime($date_start));
                $date_end_formatted = date("Y-m-d H:i:s", strtotime($date_end));
                $query->whereBetween('created_at', [$date_start_formatted, $date_end_formatted]);
            }else if($date_start != null) {
                $date_start_formatted = date("Y-m-d H:i:s", strtotime($date_start));
                $query->where('created_at', '>=', $date_start_formatted);
            }else if($date_end != null) {
                $date_end_formatted = date("Y-m-d H:i:s", strtotime($date_end));
                $query->where('created_at', '<=', $date_end_formatted);
            }

            if($user_name != null) {
                $query-with('user')->where('name', 'like', $user_name);
            }

            $data = $query->paginate(10);

            return view('admin.imports.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }
}

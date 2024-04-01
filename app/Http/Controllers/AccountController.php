<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class AccountController extends Controller
{
    public function index() {
        $data = Vendor::paginate(10);

        return view('admin.orders.index', compact('data'));
    }

    public function view($id) {
        $order_info = Order::where('id', $id)->with('user')->first();

        $order_detail_info = OrderDetail::where('order_id', $order_info->id)->with('product')->get();

        return view('admin.orders.view', compact('order_info', 'order_detail_info'));
    }

    public function edit($id) {
        $data = Order::findOrFail($id);

        return view('admin.orders.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $status = $request->input('order_type');
        $order = Order::findOrNew($id);
        $order->status = $status;
        $order->save();

        if($status == "Đã xác nhận") {
            $cart_user = Cart::where('user_id', $order->user_id)->first();

            $cart_user->delete();
        }

        return redirect('fruitya-admin/order')->with('message', 'Cập nhật thành công!');
    }
}

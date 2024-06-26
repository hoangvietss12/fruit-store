<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\GoodReceivedNote;
use App\Models\GoodReceivedNoteDetail;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            'vendor_name' => 'required',
            'product.*' => 'required',
            'quantity.*' => ['required', 'string', 'regex:/^[0-9.]+$/'],
            'price.*' => ['required', 'string', 'regex:/^[0-9]+$/']
        ],[
            'vendor_name.required' => 'Nhà cung cấp là trường bắt buộc.',
            'product.*.required' => 'Sản phẩm là trường bắt buộc.',
            'quantity.*.required' => 'Số lượng sản phẩm là trường bắt buộc.',
            'quantity.*.regex' => 'Số lượng sản phẩm phải là số.',
            'price.*.required' => 'Giá sản phẩm là trường bắt buộc.',
            'price.*.regex' => 'Giá sản phẩm phải là số.',
        ]);
    }
    public function index() {
        try {
            $data = GoodReceivedNote::orderBy('created_at', 'desc')->with('vendor')->paginate(10);
            $vendors = Vendor::all();

            return view('admin.imports.index', compact('data', 'vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function view($id) {
        try {
            $note_info = GoodReceivedNote::with('vendor')->findOrFail($id);

            $note_detail_info = GoodReceivedNoteDetail::where('goods_received_note_id', $id)->with('product')->get();

            return view('admin.imports.view', compact('note_info', 'note_detail_info'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function addVendor() {
        try {
            $vendors = Vendor::all();

            return view('admin.imports.add-vendor', compact('vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function storeVendor(Request $request) {
        try {

            $vendor_id = $request->input('vendor_name');

            $goods_received_note = new GoodReceivedNote;
            $goods_received_note->vendor_id = $vendor_id;
            $goods_received_note->created_at = Carbon::now('Asia/Bangkok');
            $goods_received_note->save();

            $products = Product::where('vendor_id', $vendor_id)->get();

            return view('admin.imports.add-details', compact('products', 'goods_received_note'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi: ' . $e->getMessage());
        }
    }

    public function storeProduct(Request $request, $id) {
        try {
            // $validator = $this->validator($request->all());

            // if($validator->fails()) {
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }

            $note = GoodReceivedNote::findOrFail($id);

            $data = $request->all();
            $total = 0;

            foreach($data['product'] as $key=>$product) {
                $goods_received_note_detail = new GoodReceivedNoteDetail;

                $goods_received_note_detail->goods_received_note_id = $id;
                $goods_received_note_detail->product_id = $product;
                $goods_received_note_detail->quantity = floatval($data['quantity'][$key]);
                $goods_received_note_detail->price = intval($data['price'][$key]);
                $goods_received_note_detail->total_price = intval($data['quantity'][$key] * $data['price'][$key]);
                $goods_received_note_detail->note = $data['note'][$key];
                $goods_received_note_detail->created_at = Carbon::now('Asia/Bangkok');
                $goods_received_note_detail->save();

                $product_model = Product::findOrFail($product);
                if($product_model->status == 'Tạm hết hàng') {
                    $product_model->status = 'Còn hàng';
                }
                $product_model->quantity += floatval($data['quantity'][$key]);;
                $product_model->save();

                $total += $goods_received_note_detail->total_price;
            }

            $note->total = $total;
            $note->save();

            return redirect('fruitya-admin/import')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi: ' . $e->getMessage());
        }
    }

    public function search(Request $request) {
        try {
            $vendor = $request->has('vendor') ? $request->input('vendor') : null;
            $date_start = $request->has('date_start') ? $request->input('date_start') : null;
            $date_end = $request->has('date_end') ? $request->input('date_end') : null;

            $query = GoodReceivedNote::query();

            if($vendor != null) {
                $query->where('vendor_id', '=', $vendor);
            }

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

            $data = $query->paginate(10);
            $vendors = Vendor::all();

            return view('admin.imports.index', compact('data', 'vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }
}

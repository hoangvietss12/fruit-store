<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceivedNote;
use App\Models\GoodsReceivedNoteDetail;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index() {
        try {
            $data = GoodsReceivedNote::orderBy('created_at', 'desc')->with('vendor')->paginate(10);
            $vendors = Vendor::all();

            return view('admin.imports.index', compact('data', 'vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function view($id) {
        try {
            $note_info = GoodsReceivedNote::findOrFail($id)->with('vendor')->first();

            $note_detail_info = GoodsReceivedNoteDetail::where('goods_received_note_id', $id)->with('product')->get();

            return view('admin.imports.view', compact('note_info', 'note_detail_info'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function addVendor() {
        try {
            $vendors = Vendor::all();

            return view('admin.imports.add-vendor', compact('vendors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function storeVendor(Request $request) {
        try {
            $vendor_id = $request->input('vendor');

            $goods_received_note = new GoodsReceivedNote;
            $goods_received_note->vendor_id = $vendor_id;
            $goods_received_note->save();

            $products = Product::where('vendor_id', $vendor_id)->get();

            return view('admin.imports.add-details', compact('products', 'goods_received_note'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi: ' . $e->getMessage());
        }
    }

    public function storeProduct(Request $request, $id) {
        try {
            $note = GoodsReceivedNote::findOrFail($id);

            $data = $request->all();
            $total = 0;

            foreach($data['product'] as $key=>$product) {
                $goods_received_note_detail = new GoodsReceivedNoteDetail;

                $goods_received_note_detail->goods_received_note_id = $id;
                $goods_received_note_detail->product_id = $product;
                $goods_received_note_detail->quantity = $data['quantity'][$key];
                $goods_received_note_detail->price = $data['price'][$key];
                $goods_received_note_detail->total_price = $data['quantity'][$key] * $data['price'][$key];
                $goods_received_note_detail->note = $data['note'][$key];
                $goods_received_note_detail->save();

                $product_model = new Product();
                $product_model->updateQuantity($product, $data['quantity'][$key]);

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

            $query = GoodsReceivedNote::query();

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
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }
}

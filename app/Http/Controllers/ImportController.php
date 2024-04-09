<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceivedNote;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index() {
        try {
            $data = GoodsReceivedNote::orderBy('created_at', 'desc')->with('vendor')->paginate(10);
            return view('admin.imports.index', compact('data'));
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

            return view('admin.imports.add-details', compact('products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }
}

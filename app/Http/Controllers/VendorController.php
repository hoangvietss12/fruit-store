<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index() {
        try {
            $data = Vendor::paginate(10);

            return view('admin.vendors.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function create() {
        return view('admin.vendors.add');
    }

    public function store(Request $request) {
        try {
            $data = new Vendor;
            $data->name = $request->vendor_name;
            $data->email = $request->vendor_email;
            $data->phone = $request->vendor_phone;
            $data->address = $request->vendor_address;
            $data->save();

            return redirect('fruitya-admin/vendor')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $data = Vendor::findOrFail($id);

            $data->delete();

            return redirect()->back()->with('message', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function edit($id) {
        try {
            $data = Vendor::findOrFail($id);

            return view('admin.vendors.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id) {
        try {
            $data = Vendor::findOrNew($id);

            $data->update([ 'name' => $request->vendor_name,
                              'email' => $request->vendor_email,
                              'phone' => $request->vendor_phone,
                              'address' => $request->vendor_address
                            ]);

            return redirect('fruitya-admin/vendor')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }
}

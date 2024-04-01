<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index() {
        $data = Vendor::paginate(10);

        return view('admin.vendors.index', compact('data'));
    }

    public function create() {
        return view('admin.vendors.add');
    }

    public function store(Request $request) {
        $data = new Vendor;
        $data->name = $request->vendor_name;
        $data->email = $request->vendor_email;
        $data->phone = $request->vendor_phone;
        $data->address = $request->vendor_address;
        $data->save();

        return redirect('fruitya-admin/vendor')->with('message', 'Thêm thành công!');
    }

    public function delete($id) {
        $data = Vendor::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('message', 'Xóa thành công!');
    }

    public function edit($id) {
        $data = Vendor::findOrFail($id);

        return view('admin.vendors.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $data = Vendor::findOrNew($id);

        $data->update([ 'name' => $request->vendor_name,
                          'email' => $request->vendor_email,
                          'phone' => $request->vendor_phone,
                          'address' => $request->vendor_address
                        ]);

        return redirect('fruitya-admin/vendor')->with('message', 'Cập nhật thành công!');
    }
}

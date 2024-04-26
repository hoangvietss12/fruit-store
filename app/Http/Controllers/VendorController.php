<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:vendors',
            'phone' => ['required', 'string', 'regex:/^[0-9 ]+$/', 'max:20'],
            'address' => 'required|string'
        ],[
            'name.required' => 'Tên nhà cung cấp là trường bắt buộc.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email phải là địa chỉ email hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.max' => 'Số điện thoại không được vượt quá :max ký tự.',
            'phone.regex' => 'Số điện thoại chỉ được chứa ký tự số và dấu cách.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
        ]);
    }
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
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new Vendor;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
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
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = Vendor::findOrNew($id);

            $data->update([ 'name' => $request->name,
                              'email' => $request->email,
                              'phone' => $request->phone,
                              'address' => $request->address
                            ]);

            return redirect('fruitya-admin/vendor')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function search(Request $request) {
        try {
            $name = $request->has('name') ? $request->name : null;
            $email = $request->has('email') ? $request->email : null;
            $phone = $request->has('phone') ? $request->phone : null;
            $address = $request->has('address') ? $request->address : null;

            $query = Vendor::query();

            if ($name !== null) {
                $query->where('name', 'like', '%'.$name.'%');
            }

            if ($email !== null) {
                $query->where('email', 'like', '%'.$email.'%');
            }

            if ($phone !== null) {
                $query->where('phone', 'like', '%'.$phone.'%');
            }

            if ($address !== null) {
                $query->where('address', 'like', '%'.$address.'%');
            }

            $data = $query->paginate(10);

            return view('admin.vendors.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }
}

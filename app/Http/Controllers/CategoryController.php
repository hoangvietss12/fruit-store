<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            'category_name' => 'required|string'
        ],[
            'category_name.required' => 'Danh mục sản phẩm là trường bắt buộc.'
        ]);
    }
    public function index() {
        try {
            $data = Category::all();

            return view('admin.categories.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function create() {
        return view('admin.categories.add');
    }

    public function store(Request $request) {
        try {
            $validator = $this->validator($request->all());

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new Category;
            $data->name = $request->category_name;
            $data->save();

            return redirect('fruitya-admin/category')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $data = Category::find($id);

            $data->delete();

            return redirect()->back()->with('message', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function edit($id) {
        try {
            $data = Category::find($id);

            return view('admin.categories.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id) {
        try {

            $validator = $this->validator($request->all());

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $category = Category::find($id);
            $category->update(['name' => $request->category_name]);
            
            return redirect('fruitya-admin/category')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }

    public function search(Request $request) {
        try {
            $keyword = $request->category_name;
            $data = Category::where('name', 'like', '%'.$keyword.'%')->get();

            return view('admin.categories.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: ' . $e->getMessage());
        }
    }
}

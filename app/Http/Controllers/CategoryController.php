<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $data = Category::all();

        return view('admin.categories.index', compact('data'));
    }

    public function create() {
        return view('admin.categories.add');
    }

    public function store(Request $request) {
        $data = new Category;
        $data->category_name = $request->category_name;
        $data->save();

        return redirect('category')->with('message', 'Thêm thành công!');
    }

    public function delete($id) {
        $data = Category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Xóa thành công!');
    }

    public function edit($id) {
        $data = Category::find($id);

        return view('admin.categories.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $input = $request->only(['category_name']);;
        $category = Category::findOrNew($id);
        $category->update($input);

        return redirect('category')->with('message', 'Cập nhật thành công!');
    }
}

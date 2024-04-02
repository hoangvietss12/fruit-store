<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Vendor;

class AccountController extends Controller
{
    public function index() {
        $data = User::where('user_type', 0)->paginate(10);

        return view('admin.accounts.index', compact('data'));
    }

    public function view($id) {
        $data = User::where('id', $id)->first();

        return view('admin.accounts.view', compact('data'));
    }

    public function edit($id) {
        $data = User::findOrFail($id);

        return view('admin.accounts.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $status = $request->input('account_status');
        $account = User::findOrNew($id);
        $account->status = $status;
        $account->save();

        return redirect('fruitya-admin/account')->with('message', 'Cập nhật thành công!');
    }
}

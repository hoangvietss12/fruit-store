<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Vendor;

class AccountController extends Controller
{
    public function index() {
        try {
            $data = User::where('user_type', 0)->paginate(10);

            return view('admin.accounts.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function view($id) {
        try {
            $data = User::where('id', $id)->first();

            $this->createUrlImage($data);

            return view('admin.accounts.view', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function edit($id) {
        try {
            $data = User::findOrFail($id);

            return view('admin.accounts.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $status = $request->input('account_status');
            $account = User::findOrNew($id);
            $account->status = $status;
            $account->save();

            return redirect('fruitya-admin/account')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    public function search(Request $request) {
        try {
            $name = $request->has('account_name') ? $request->account_name : null;
            $email = $request->has('account_email') ? $request->account_email : null;
            $status = $request->has('account_status') ? $request->input('account_status') : null;

            $query = User::query();

            if ($name !== null) {
                $query->where('name', 'like', '%'.$name.'%');
            }

            if ($email !== null) {
                $query->where('email', 'like', '%'.$email.'%');
            }

            if ($status !== null) {
                $query->where('status', $status);
            }

            $data = $query->where('user_type', 0)->paginate(10);

            return view('admin.accounts.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lối: Vui lòng thử lại sau!');
        }
    }

    private function createUrlImage($account) {
        $bucket = app('firebase.storage')->getBucket('fruit-ya.appspot.com');

            $imageReference = $bucket->object($account->profile_photo_path);

            if ($imageReference->exists()) {
                $expiresAt = new \DateTime('tomorrow');
                $imageUrl = $imageReference->signedUrl($expiresAt);
            }

        $account->profile_photo_path = $imageUrl;
    }
}

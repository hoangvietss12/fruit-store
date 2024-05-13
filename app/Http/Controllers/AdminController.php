<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;


class AdminController extends Controller
{
    public function index() {
        $dara = 1;

        return view('admin.dashboard', compact('dara'));
    }

    public function session() {
        $data = Session::with('user')->paginate(10);

        return view('admin.session', compact('data'));
    }
}

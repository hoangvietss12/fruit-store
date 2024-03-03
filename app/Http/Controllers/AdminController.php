<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class AdminController extends Controller
{
    public function index() {
        $dara = 1;

        return view('admin.dashboard.index', compact('dara'));
    }
}

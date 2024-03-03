<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::prefix('store')->group(function() {
        Route::get('/', [HomeController::class, 'store'])->name('home.store');

        Route::get('/{category}', [HomeController::class, 'getProductsByCategory'])->name('store.category');
    });

    Route::get('/load-more-products', [HomeController::class, 'loadMoreProducts'])->name('load.more.products');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);

// Admin Page
Route::prefix('adminn')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');

    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');

    Route::post('/', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

    Route::post('/{id}', [CategoryController::class, 'update'])->name('category.update');
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');

    Route::get('/create', [ProductController::class, 'create'])->name('product.create');

    Route::post('/', [ProductController::class, 'store'])->name('product.store');

    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');

    Route::post('/{id}', [ProductController::class, 'update'])->name('product.update');
});



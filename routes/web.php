<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
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

    Route::prefix('cart')->group(function() {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');

        Route::post('/{id}', [CartController::class, 'addToCart'])->name('cart.store');
    });

    Route::prefix('purchase')->group(function() {
        Route::get('/', [PurchaseController::class, 'index'])->name('purchase.index');
        Route::post('/', [PurchaseController::class, 'checkout'])->name('purchase.order');
        Route::get('/cancel', [PurchaseController::class, 'cancel'])->name('purchase.cancel');

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


// Admin Page
Route::prefix('fruitya-admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

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

        Route::get('/view/{id}', [ProductController::class, 'view'])->name('product.view');

        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');

        Route::post('/{id}', [ProductController::class, 'update'])->name('product.update');
    });

    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');

        Route::get('/view/{id}', [OrderController::class, 'view'])->name('order.view');

        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');

        Route::get('/print/{id}', [OrderController::class, 'print'])->name('order.print');

        Route::post('/{id}', [OrderController::class, 'update'])->name('order.update');
    });

    Route::prefix('vendor')->group(function () {
        Route::get('/', [VendorController::class, 'index'])->name('vendor.index');

        Route::get('/create', [VendorController::class, 'create'])->name('vendor.create');

        Route::post('/', [VendorController::class, 'store'])->name('vendor.store');

        Route::get('/delete/{id}', [VendorController::class, 'delete'])->name('vendor.delete');

        Route::get('/edit/{id}', [VendorController::class, 'edit'])->name('vendor.edit');

        Route::post('/{id}', [VendorController::class, 'update'])->name('vendor.update');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

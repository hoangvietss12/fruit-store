<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportProductController;
use App\Http\Controllers\ReportSaleController;
use App\Http\Controllers\ReportImportController;
use App\Http\Controllers\ReportRevenueController;
use App\Http\Controllers\StoreController;
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
Route::prefix('/')->middleware('checkUserType')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/about', [HomeController::class, 'about'])->name('home.about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
    Route::get('/history', [HomeController::class, 'history'])->name('home.history');

    Route::prefix('store')->group(function() {
        Route::get('/', [StoreController::class, 'index'])->name('store.index');

        Route::get('/{id}', [StoreController::class, 'product'])->name('store.product');

        Route::post('/search', [StoreController::class, 'search'])->name('store.search');

        Route::post('/filter', [StoreController::class, 'filter'])->name('store.filter');
    });

    Route::prefix('cart')->middleware('checkLoggedIn')->group(function() {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');

        Route::get('/{id}', [CartController::class, 'addToCart'])->name('cart.store');

        Route::get('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

        Route::get('/search', [CartController::class, 'searchCart'])->name('cart.search');
    });

    Route::prefix('purchase')->middleware('checkLoggedIn')->group(function() {
        Route::get('/', [PurchaseController::class, 'index'])->name('purchase.index');

        Route::get('/order', [PurchaseController::class, 'orderFromCart'])->name('purchase.order');

        Route::post('/', [PurchaseController::class, 'checkout'])->name('purchase.submit');
        Route::get('/cancel', [PurchaseController::class, 'cancel'])->name('purchase.cancel');

        Route::post('/payment', [PaymentController::class, 'index'])->name('payment.index');
        Route::get('/return', [PaymentController::class, 'purchaseReturn'])->name('payment.return');
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
Route::prefix('fruitya-admin')->middleware('checkUserType')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/history', [AdminController:: class, 'session'])->name('admin.history');

    Route::prefix('category')->group(function () {
        Route::middleware('checkUserType')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');

            Route::get('/create', [CategoryController::class, 'create'])->name('category.create');

            Route::post('/{id}', [CategoryController::class, 'update'])->name('category.update');

            Route::post('/', [CategoryController::class, 'store'])->name('category.store');

            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

            Route::get('/search', [CategoryController::class, 'search'])->name('category.search');
        });
    });

    Route::prefix('product')->group(function () {
        Route::middleware('checkUserType')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');

            Route::get('/create', [ProductController::class, 'create'])->name('product.create');

            Route::post('/search', [ProductController::class, 'search'])->name('product.search');

            Route::post('/', [ProductController::class, 'store'])->name('product.store');

            Route::get('/view/{id}', [ProductController::class, 'view'])->name('product.view');

            Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');

            Route::post('/{id}', [ProductController::class, 'update'])->name('product.update');

        });
    });

    Route::prefix('order')->group(function () {
        Route::middleware('checkUserType')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('order.index');

            Route::get('/view/{id}', [OrderController::class, 'view'])->name('order.view');

            Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');

            Route::get('/print/{id}', [OrderController::class, 'print'])->name('order.print');

            Route::post('/{id}', [OrderController::class, 'update'])->name('order.update');

            Route::get('/search', [OrderController::class, 'search'])->name('order.search');
        });
    });

    Route::prefix('vendor')->group(function () {
        Route::middleware('checkUserType')->group(function () {
            Route::get('/', [VendorController::class, 'index'])->name('vendor.index');

            Route::get('/create', [VendorController::class, 'create'])->name('vendor.create');

            Route::post('/search', [VendorController::class, 'search'])->name('vendor.search');

            Route::post('/{id}', [VendorController::class, 'update'])->name('vendor.update');

            Route::post('/', [VendorController::class, 'store'])->name('vendor.store');

            Route::get('/delete/{id}', [VendorController::class, 'delete'])->name('vendor.delete');

            Route::get('/edit/{id}', [VendorController::class, 'edit'])->name('vendor.edit');


        });
    });

    Route::prefix('account')->group(function () {
        Route::middleware('checkUserType')->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('account.index');

            Route::get('/view/{id}', [AccountController::class, 'view'])->name('account.view');

            Route::get('/edit/{id}', [AccountController::class, 'edit'])->name('account.edit');

            Route::post('/search', [AccountController::class, 'search'])->name('account.search');

            Route::post('/{id}', [AccountController::class, 'update'])->name('account.update');
        });
    });

    Route::prefix('import')->group(function () {
        Route::middleware('checkUserType')->group(function () {
            Route::get('/', [ImportController::class, 'index'])->name('import.index');

            Route::get('/view/{id}', [ImportController::class, 'view'])->name('import.view');

            Route::get('/create', [ImportController::class, 'addVendor'])->name('import.create');

            Route::post('/', [ImportController::class, 'storeVendor'])->name('import.store');

            Route::post('/{id}', [ImportController::class, 'storeProduct'])->name('import.store.product');

            Route::get('/search', [ImportController::class, 'search'])->name('import.search');
        });
    });

    Route::prefix('report')->group(function () {
        Route::middleware('checkUserType')->group(function () {
            Route::get('/products', [ReportProductController::class, 'indexProduct'])->name('report.product.index');

            Route::post('/products/search', [ReportProductController::class, 'searchProduct'])->name('report.product.search');

            Route::get('/products/export/{categoryId?}/{vendorId?}/{start?}/{end?}', [ReportProductController::class, 'exportProduct'])->name('report.product.export');

            Route::get('/revenue', [ReportRevenueController::class, 'indexRevenue'])->name('report.revenue.index');

            Route::post('/revenue/search', [ReportRevenueController::class, 'searchRevenue'])->name('report.revenue.search');

            Route::get('/revenue/export/{start?}/{end?}', [ReportRevenueController::class, 'exportRevenue'])->name('report.revenue.export');

            Route::get('/sales', [ReportSaleController::class, 'indexSale'])->name('report.sale.index');

            Route::post('/sales/search', [ReportSaleController::class, 'searchSale'])->name('report.sale.search');

            Route::get('/sales/export/{categoryId?}/{vendorId?}/{start?}/{end?}', [ReportSaleController::class, 'exportSale'])->name('report.sale.export');

            Route::get('/imports', [ReportImportController::class, 'indexImport'])->name('report.import.index');

            Route::post('/imports/search', [ReportImportController::class, 'searchImport'])->name('report.import.search');

            Route::get('/imports/export/{categoryId?}/{vendorId?}/{start?}/{end?}', [ReportImportController::class, 'exportImport'])->name('report.import.export');
        });
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

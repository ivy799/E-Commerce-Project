<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductBuyerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Product_detailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [HomeController::class, 'index'])->name('seller.dashboard');
    Route::resource('/seller/stores', StoreController::class)->names([
        'index' => 'seller.stores.index',
        'create' => 'seller.stores.create',
        'store' => 'seller.stores.store',
        'show' => 'seller.stores.show',
        'edit' => 'seller.stores.edit',
        'update' => 'seller.stores.update',
        'destroy' => 'seller.stores.destroy',
    ]);

    Route::resource('/seller/products', ProductController::class)->names([
        'index' => 'seller.products.index',
        'create' => 'seller.products.create',
        'store' => 'seller.products.store',
        'show' => 'seller.products.show',
        'edit' => 'seller.products.edit',
        'update' => 'seller.products.update',
        'destroy' => 'seller.products.destroy',
    ]);

    // Route::resource('/seller/product_details', Product_detailsController::class)->names([
    //     'index' => 'seller.product_details.index',
    //     'create' => 'seller.product_details.create',
    //     'store' => 'seller.product_details.store',
    //     'show' => 'seller.product_details.show',
    //     'edit' => 'seller.product_details.edit',
    //     'update' => 'seller.product_details.update',
    //     'destroy' => 'seller.product_details.destroy',
    // ]);
});

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/buyer/dashboard', [HomeController::class, 'index'])->name('buyer.dashboard');
    Route::get('/buyer/products/{product}', [ProductBuyerController::class, 'show'])->name('buyer.products.show');
    Route::post('/buyer/cart', [CartController::class, 'store'])->name('buyer.cart.store');
    Route::get('/buyer/cart', [CartController::class, 'index'])->name('buyer.cart.index');
    Route::patch('/buyer/cart/{cart}', [CartController::class, 'update'])->name('buyer.cart.update');
});

require __DIR__.'/auth.php';
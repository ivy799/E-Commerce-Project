<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProductBuyerController,
    ProfileController,
    UserController,
    StoreController,
    ProductController,
    FavoriteController,
    CartController,
    OrderController,
    CommentRatingController
};






// Authenticated Routes
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});







// Public Routes
Route::get('/', [ProductController::class, 'welcome'])->name('welcome');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/filter', [HomeController::class, 'filter'])->name('filter');
Route::get('/welcome/search', [HomeController::class, 'welcomeSearch'])->name('welcome.search');
Route::get('/welcome/filter', [HomeController::class, 'welcomeFilter'])->name('welcome.filter');







// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.home');
    //menggunakan route manual karna nama tidak sesuai dengan nama restfull standar(index,destroy, dll) saya memakai nama custom 
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::delete('/admin/products/{product}', [ProductController::class, 'adminDestroy'])->name('admin.products.destroy');
    
    Route::resource('/admin/users', UserController::class)->names([
        'index'   => 'admin.users.index',
        'create'  => 'admin.users.create',
        'store'   => 'admin.users.store',
        'show'    => 'admin.users.show',
        'edit'    => 'admin.users.edit',
        'update'  => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});





// Seller Routes
Route::middleware(['auth', 'role:seller'])->group(function () {
    // Route::get('/seller/dashboard', [HomeController::class, 'index'])->name('seller.dashboard');

    Route::resource('/seller/stores', StoreController::class)->names([
        'index'   => 'seller.stores.index',
        'create'  => 'seller.stores.create',
        'store'   => 'seller.stores.store',
        'show'    => 'seller.stores.show',
        'edit'    => 'seller.stores.edit',
        'update'  => 'seller.stores.update',
        'destroy' => 'seller.stores.destroy',
    ]);

    Route::resource('/seller/products', ProductController::class)->names([
        'index'   => 'seller.products.index',
        'create'  => 'seller.products.create',
        'store'   => 'seller.products.store',
        'show'    => 'seller.products.show',
        'edit'    => 'seller.products.edit',
        'update'  => 'seller.products.update',
        'destroy' => 'seller.products.destroy',
    ]);

    Route::get('/seller/orders', [OrderController::class, 'sellerOrderList'])->name('seller.orders.index');
    Route::patch('/seller/orders/{order}/ship', [OrderController::class, 'shipOrder'])->name('seller.orders.ship');
    // Route::get('/seller/orders/{order}', [OrderController::class, 'show'])->name('seller.orders.show');
    // Route::get('/seller/orders/all', [OrderController::class, 'allOrdersFromBuyers'])->name('seller.orders.all');
});








// Buyer Routes
Route::middleware(['auth', 'role:buyer'])->group(function () {

    Route::get('/buyer/products/{product}', [ProductBuyerController::class, 'show'])->name('buyer.products.show'); //product details
    
    //cart
    Route::resource('/buyer/cart', CartController::class)->names([
        'index'   => 'buyer.cart.index',
        'store'   => 'buyer.cart.store',
        'update'  => 'buyer.cart.update',
        'destroy' => 'buyer.cart.destroy',
    ]);
    
    //favorite
    Route::resource('/buyer/favorites', FavoriteController::class)->names([
        'index'   => 'buyer.favorites.index',
        'store'   => 'buyer.favorites.store',
        'destroy' => 'buyer.favorites.destroy',
    ]);
    
    //order
    Route::resource('/buyer/orders', OrderController::class)->names([
        'index'   => 'buyer.orders.index',
        // 'create'  => 'buyer.orders.create',
        'store'   => 'buyer.orders.store',
        'show'    => 'buyer.orders.show',
    ]);


    Route::post('/products/{product}/comments', [CommentRatingController::class, 'store'])->name('comments.store'); //melaukan comment dan rating pada product
    Route::post('/buyer/orders/details', [OrderController::class, 'storeOrderDetails'])->name('buyer.orders.details.store'); //pembuatan orderdetails dari order buy now 
    Route::post('/buyer/orders/checkout', [OrderController::class, 'checkout'])->name('buyer.orders.checkout'); //membeli melalui cart (checkout)
    Route::get('/buyer/orders/buy-now/{product}', [OrderController::class, 'buyNow'])->name('buyer.orders.buyNow'); //membeli langsung tanpa melalui cart
    // Route::get('/buyer/dashboard', [HomeController::class, 'index'])->name('buyer.dashboard');
});

require __DIR__ . '/auth.php';

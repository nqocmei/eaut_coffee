<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
    AdminController,
    ProductController,
    CategoriesController,
    OrderController,
    BannerController,
    ConfigurationController
};

use App\Http\Controllers\{
    HomeController,
    AuthController,
    OrderSiteController,
    CartController,
    ProductSiteController,
    UserController,
};

use App\Http\Controllers\PasswordResetController;

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

Route::get('/password/reset', [PasswordResetController::class, 'showEmailForm'])->name('password.request');
Route::post('/password/reset', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset/{token}', [PasswordResetController::class, 'resetPassword'])->name('password.update');

//Frontend
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/detail/{id}', [ProductSiteController::class, 'detail'])->name('detail');
Route::post('/product/comments', [ProductSiteController::class, 'store'])->name('comments.store');

Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/view-all', [HomeController::class, 'viewAll'])->name('viewAll');
Route::get('/services', [HomeController::class, 'services'])->name('services');
//cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [CartController::class, 'addProductToCart'])->name('add_to_cart');
Route::put('/update-quantity-cart', [CartController::class, 'updateQuantityCart'])->name('update_quantity_cart');
Route::get('/buy-now/{id}', [CartController::class, 'buyNow'])->name('buy_now');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/order-cod', [CartController::class, 'order'])->name('order-cod');
Route::post('/vnpay', [CartController::class, 'vnpay'])->name('vnpay');
Route::get('/order-success', [CartController::class, 'orderSuccess'])->name('order_success');

//order
Route::get('/order', [OrderSiteController::class, 'index'])->name('site.order');

Route::prefix('/')->middleware('orderview')->group(function () {
    Route::get('/order/edit/{id}', [OrderSiteController::class, 'showEdit'])->name('order.edit');
    Route::put('/order/edit/{id}', [OrderSiteController::class, 'update'])->name('order.update');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

// user
Route::get('/profile', [UserController::class, 'profile'])->name('user_profile');
Route::put('/profile', [UserController::class, 'update'])->name('user_profile_update');

// 404
Route::get('/404', function () {
    return view('pages.notFound');
})->name('404');

Route::fallback(function () {
    return redirect()->route('404');
})->name('redirect.404');

//admin
Route::prefix('/')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/signinDashboard', [AdminController::class, 'signin_dashboard']);
});

Route::prefix('/')->middleware('admin.login')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin_logout', [AdminController::class, 'admin_logout']);

    Route::prefix('/admin')->group(function () {
        Route::prefix('/product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::post('/', [ProductController::class, 'store'])->name('product.store');
            Route::get('/search', [AdminController::class, 'search'])->name('search.product');
            Route::get('/create', [ProductController::class, 'create'])->name('product.create');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
            Route::put('/update/{product}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
        });
        Route::prefix('/category')->group(function () {
            Route::get('/', [CategoriesController::class, 'index'])->name('category.index');
            Route::post('/', [CategoriesController::class, 'store'])->name('category.store');
            Route::get('/create', [CategoriesController::class, 'create'])->name('category.create');
            Route::get('/edit/{category}', [CategoriesController::class, 'edit'])->name('category.edit');
            Route::put('/update/{category}', [CategoriesController::class, 'update'])->name('category.update');
            Route::delete('/{category}/destroy', [CategoriesController::class, 'destroy'])->name('category.destroy');
        });
        Route::prefix('/orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/edit/{orders}', [OrderController::class, 'edit'])->name('orders.edit');
            Route::put('/update/{orders}', [OrderController::class, 'update'])->name('orders.update');
        });
        Route::prefix('/banner')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('banner.index');
            Route::post('/', [BannerController::class, 'store'])->name('banner.store');
            Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
            Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('banner.edit');
            Route::put('/update/{bannerId}', [BannerController::class, 'update'])->name('banner.update');
            Route::delete('/{banner}/destroy', [BannerController::class, 'destroy'])->name('banner.destroy');
        });

        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'getAllUser'])->name('users.get-all');
            Route::get('/search', [UserController::class, 'searchUsers'])->name('users.search');
        });

        Route::prefix('/settings')->group(function () {
            Route::get('/', [ConfigurationController::class, 'settings'])->name('settings');
            Route::put('/configuration/update', [ConfigurationController::class, 'update'])->name('configuration.update');
        });
    });
});







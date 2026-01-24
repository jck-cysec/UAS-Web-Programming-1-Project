<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController as UserOrderController;use App\Http\Controllers\User\ProfileController;use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\OrderExportController as UserOrderExportController;
use App\Http\Controllers\Admin\OrderExportController as AdminOrderExportController;

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// CSP report endpoint used in report-only mode. Accepts JSON reports from browsers.
Route::post('/csp-report', function (\Illuminate\Http\Request $request) {
    if ($request->isJson()) {
        \Illuminate\Support\Facades\Log::channel('csp')->warning('CSP report received', ['report' => $request->all(), 'ip' => $request->ip()]);
    } else {
        \Illuminate\Support\Facades\Log::channel('csp')->warning('CSP report (non-json) received', ['body' => $request->getContent(), 'ip' => $request->ip()]);
    }
    return response()->json(['status' => 'ok']);
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{game}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update')
        ->middleware('ensure.owner:App\\Models\\Cart,cart');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove')
        ->middleware('ensure.owner:App\\Models\\Cart,cart');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])
    ->name('cart.destroy')
    ->middleware(['auth', 'verified']);

    // Orders
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::post('/checkout', [UserOrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show')
        ->middleware('ensure.owner:App\\Models\\Order,order');
    // Allow user to delete their own order
    Route::delete('/orders/{order}', [UserOrderController::class, 'destroy'])->name('orders.destroy')
        ->middleware('ensure.owner:App\\Models\\Order,order');

    // Exports (user) - invoice export as PDF / Excel
    Route::get('/orders/{order}/export/pdf', [UserOrderExportController::class, 'pdf'])->name('orders.export.pdf')
        ->middleware('ensure.owner:App\\Models\\Order,order');
    Route::get('/orders/{order}/export/excel', [UserOrderExportController::class, 'excel'])->name('orders.export.excel')
        ->middleware('ensure.owner:App\\Models\\Order,order');

    // Reviews
    Route::post('/games/{game}/review', [HomeController::class, 'storeReview'])->name('games.review');

    // Wishlist
    Route::post('/wishlist/toggle/{game}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'changePasswordForm'])->name('profile.password');
    Route::post('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password.update');
});

/*
|--------------------------------------------------------------------------
| Public User Routes
|--------------------------------------------------------------------------
*/
Route::get('/games', [HomeController::class, 'games'])->name('games.index');
Route::get('/games/{game}', [HomeController::class, 'show'])->name('games.show');
Route::get('/search', [HomeController::class, 'search'])->name('games.search');
Route::get('/news/{news}', [HomeController::class, 'showNews'])->name('news.show');

/*
|--------------------------------------------------------------------------
| User Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [UserAuthController::class, 'login'])->middleware('guest','throttle:login');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.post')->middleware('guest','throttle:register');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', function () {
    return redirect('/login');
});
Route::post('/admin/logout', [UserAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Games
    Route::resource('games', GameController::class);

    // Categories (Genres)
    Route::resource('categories', CategoryController::class);

    // News
    Route::resource('news', NewsController::class);

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    // Allow admin to delete orders
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Exports (admin) - orders report export as PDF / Excel (optional date filters via query: from=YYYY-MM-DD&to=YYYY-MM-DD)
    Route::get('/orders/export/pdf', [AdminOrderExportController::class, 'pdf'])->name('orders.export.pdf');
    Route::get('/orders/export/excel', [AdminOrderExportController::class, 'excel'])->name('orders.export.excel');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

    // Reviews Moderation
    Route::get('/reviews', [GameController::class, 'reviews'])->name('reviews.index');
    Route::patch('/reviews/{review}/approve', [GameController::class, 'approveReview'])->name('reviews.approve');
    Route::delete('/reviews/{review}', [GameController::class, 'deleteReview'])->name('reviews.destroy');
});

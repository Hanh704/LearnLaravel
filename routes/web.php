<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Product;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/from-register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'Register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Route quản lí sản phẩm
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/',                 [ProductController::class, 'index'])->name('index');
        Route::get('/{id}/show',        [ProductController::class, 'show'])->name('show');
        Route::get('/create',           [ProductController::class, 'create'])->name('create');
        Route::post('/store',           [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit',        [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}/update',      [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',  [ProductController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/restore',    [ProductController::class, 'restore'])->name('restore');
        Route::post('/{id}/deletePermanently',  [ProductController::class, 'deletePermanently'])->name('deletePermanently');
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/',             [CategoryController::class, 'index'])->name('index');
        Route::get('/{id}/show',    [CategoryController::class, 'show'])->name('show');
        Route::get('/create',             [CategoryController::class, 'create'])->name('create');
        Route::post('/store',             [CategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit',             [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/update',             [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',             [CategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/',                     [CustomerController::class, 'index'])->name('index');
        Route::get('/{id}/show',            [CustomerController::class, 'show'])->name('show');
        Route::get('/create',               [CustomerController::class, 'create'])->name('create');
        Route::post('/store',               [CustomerController::class, 'store'])->name('store');
        Route::get('/{id}/edit',            [CustomerController::class, 'edit'])->name('edit');
        Route::put('/{id}/update',          [CustomerController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',      [CustomerController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('banners')->name('banners.')->group(function () {
        Route::get('/',                     [BannerController::class, 'index'])->name('index');
        Route::get('/create',               [BannerController::class, 'create'])->name('create');
        Route::post('/store',               [BannerController::class, 'store'])->name('store');
        Route::get('/{id}/edit',            [BannerController::class, 'edit'])->name('edit');
        Route::put('/{id}/update',          [BannerController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',      [BannerController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/restore',        [BannerController::class, 'restore'])->name('restore');
        Route::post('/{id}/deletePermanently',  [BannerController::class, 'deletePermanently'])->name('deletePermanently');
    });
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/',                     [PostController::class, 'index'])->name('index');
        Route::get('/create',               [PostController::class, 'create'])->name('create');
        Route::post('/store',               [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit',            [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}/update',          [PostController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',      [PostController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/restore',        [PostController::class, 'restore'])->name('restore');
        Route::post('/{id}/deletePermanently',  [PostController::class, 'deletePermanently'])->name('deletePermanently');
    });
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/',                     [ReviewController::class, 'index'])->name('index');
        Route::get('/create',               [ReviewController::class, 'create'])->name('create');
        Route::post('/store',               [ReviewController::class, 'store'])->name('store');
        Route::get('/{id}/edit',            [ReviewController::class, 'edit'])->name('edit');
        Route::put('/{id}/update',          [ReviewController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',      [ReviewController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/restore',        [ReviewController::class, 'restore'])->name('restore');
        Route::post('/{id}/deletePermanently',  [ReviewController::class, 'deletePermanently'])->name('deletePermanently');
    });
});
Route::prefix('client')->name('client.')->group(function () {
    // Route cho trang client
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Sản phẩm client
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ClientController::class, 'productIndex'])->name('index');
        Route::get('/{id}', [ClientController::class, 'productShow'])->name('show');
    });

    // Bài viết client
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [ClientController::class, 'postIndex'])->name('index');
        Route::get('/{id}', [ClientController::class, 'postShow'])->name('show');
    });

    // Đánh giá client
    Route::middleware('auth')->group(function () {
        Route::post('/products/{product}/reviews', [ClientController::class, 'reviewStore'])->name('reviews.store');
    });

    // Liên hệ client
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Thêm route profile
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [ClientController::class, 'updateProfile'])->name('profile.update');
    });
});

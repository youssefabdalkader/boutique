<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
});
// ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// front end pages

Route::resource('product', ProductController::class)
    ->middleware('RedirectGuest');

Route::prefix('user')->as('frontend.')->middleware('RedirectGuest')->group(function () {
    Route::get('/shop', function () {
        return view('frontend.shop');
    })->name('shop');
    Route::get('/detail', function () {
        return view('frontend.detail');
    })->name('detail');
    Route::get('/cart', function () {
        return view('frontend.cart');
    })->name('cart');
    Route::get('/checkout', function () {
        return view('frontend.checkout');
    })->name('checkout');
    Route::get('/contact', function () {
        return view('frontend.contact');
    })->name('contact');
});
// backend pages
Route::prefix('admin')->as('admin.')->group(function () {

    Route::get('/login', function () {
        return view('backend.login');
    })->name('login')->middleware('guest');

    Route::middleware('Redirectadmin')->group(function () {
        Route::get('/index', function () {
            return view('backend.index');
        })->name('index');

        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);
        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
        Route::resource('tag', TagController::class);
    });
});

require __DIR__ . '/auth.php';
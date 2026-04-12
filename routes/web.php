<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\UserController;

// Home route redirects
Route::get('/', function () {
    return auth()->check()
        ? (Auth::user()->role === 'admin'
            ? redirect('/admin/dashboard')
            : redirect('/home'))
        : redirect('/login');
});

// Guest routes (NOT logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {

    

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
}); 

//USER midware
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('user.home');
    Route::get('/menu', [UserController::class, 'menu'])->name('user.menu');
    Route::get('/menu/{menuItem}', [UserController::class, 'itemDetails'])->name('user.menu.item');

    Route::post('/cart/add/{id}', [UserController::class, 'addToCart'])
    ->name('cart.add');
    Route::get('/cart', [UserController::class, 'cart'])->name('user.cart');
    Route::post('/cart/update/{id}', [UserController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove/{id}', [UserController::class, 'removeFromCart'])->name('cart.remove');

    Route::get('/bundles', [UserController::class, 'bundles'])->name('user.bundles');
    Route::get('/bundles/{bundle}', [UserController::class, 'bundleDetails'])->name('user.bundle.info');
    Route::post('/bundle/select/{id}', [UserController::class, 'selectBundle'])
    ->name('bundle.select');
    Route::post('/bundle/update', [UserController::class, 'updateBundle'])->name('bundle.update');
    Route::post('/bundle/remove', [UserController::class, 'removeBundle'])->name('bundle.remove');


    Route::get('/book', [UserController::class, 'book'])->name('user.book');
    Route::post('/book', [UserController::class, 'storeBooking'])->name('user.book.store');

    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
});

// Admin routes (ROLE PROTECTED)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/menu', [AdminController::class, 'menu'])->name('admin.menu');

    Route::get('/bundles', [AdminController::class, 'bundles'])->name('admin.bundles');

    Route::get('/management', [AdminController::class, 'management'])->name('admin.management');

    Route::get('/addmenu', [MenuItemController::class, 'index'])->name('admin.management.addmenu');

    Route::get('/addbundle', [BundleController::class, 'create'])->name('admin.management.addbundle');


    // Menu Item
    Route::post('/menu', [MenuItemController::class, 'store'])->name('admin.menu.store');
    Route::delete('/menu/{menuItem}', [MenuItemController::class, 'destroy'])->name('admin.menu.destroy');

    // Santi
    Route::get('/menu/{menuItem}/edit', [MenuItemController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/menu/{menuItem}', [MenuItemController::class, 'update'])->name('admin.menu.update');

    //BUNDLES 
    Route::post('/bundles', [BundleController::class, 'store'])->name('admin.bundles.store');
    Route::get('/bundles/{bundle}/edit', [BundleController::class, 'edit'])->name('admin.bundles.edit');
    Route::put('/bundles/{bundle}', [BundleController::class, 'update'])->name('admin.bundles.update');
    Route::delete('/bundles/{bundle}', [BundleController::class, 'destroy'])->name('admin.bundles.destroy'); 

    //INQUIRIES
    // Admin view (list + optional selected inquiry)
    Route::get('/inquiries/{id?}', [AdminController::class, 'inquiries'])
    ->name('admin.inquiries');

    Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
    Route::post('/inquiries/{id}/reply', [InquiryController::class, 'reply'])->name('inquiries.reply');
    Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy'])->name('inquiries.delete');

    //BOOKINGS 
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/bookings/{booking}', [AdminController::class, 'showBooking'])->name('admin.bookings.show');

    //PROFILE
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

});
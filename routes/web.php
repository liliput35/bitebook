<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuItemController;

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
    Route::get('/home', [HomeController::class, 'index'])->name('user.home');
});

// Admin routes (ROLE PROTECTED)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/menu', [AdminController::class, 'menu'])->name('admin.menu');

    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('admin.inquiries');

    Route::post('/menu', [MenuItemController::class, 'store'])->name('admin.menu.store');
    Route::delete('/menu/{menuItem}', [MenuItemController::class, 'destroy'])->name('admin.menu.destroy');
});
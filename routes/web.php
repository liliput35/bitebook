<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuItemController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard redirect
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/menu', [AdminController::class, 'menu'])->name('admin.menu');
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('admin.inquiries');
});

// Menu Item
Route::post('/menu', [MenuItemController::class, 'store'])->name('admin.menu.store');
Route::delete('/menu/{menuItem}', [MenuItemController::class, 'destroy'])->name('admin.menu.destroy');
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

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
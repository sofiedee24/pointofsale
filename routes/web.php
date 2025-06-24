<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

// Redirect root to login
Route::get('/', fn() => redirect('/login'));

// Auth Routes
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->name('home');
    Route::post('/logout', 'logout')->name('logout');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('customers', CustomerController::class)->only(['index', 'create']);
    Route::resource('admins', AdminController::class)->only(['index', 'create']);
    Route::resource('categories', CategoryController::class)->only(['index', 'create', 'edit']);
    Route::resource('products', ProductController::class)->only(['index', 'create']);
});


// 👋 Test route
Route::get('/greeting', fn() => 'Hello World');

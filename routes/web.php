<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->name('home');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/dashboard', [PosController::class, 'dashboard'])->name('dashboard');

Route::get('/addcustomer', [PosController::class, 'addCustomer'])->name('addcustomer');

Route::get('/customerview', [PosController::class, 'customerList'])->name('customerList');

Route::get('/addadmin', [PosController::class, 'addAdmin'])->name('addadmin');

Route::get('/adminlist', [PosController::class, 'adminList'])->name('adminlist');

Route::get('/addcategory', [PosController::class, 'addCategory'])->name('addcategory');

Route::get('/categoryview', [PosController::class, 'categoryList'])->name('categorylist');

Route::get('/editingcategory', [PosController::class, 'editCategory'])->name('editcategory');

Route::get('/addingproducts', [PosController::class, 'addProducts'])->name('addproducts');

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/productview', [PosController::class, 'viewProducts'])->name('productslist');

    //Route::get('/registrar');

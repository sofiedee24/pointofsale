<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

    Route::get('/', function () {
    return view('welcome');
    });

    Route::middleware('guest')->controller(LoginRegisterController::class)->group(function() {
        Route::get('/register', 'register')->name('register');
        Route::post('/store', 'store')->name('store');
        Route::get('/login', 'login')->name('login');
        Route::post('/authenticate', 'authenticate')->name('authenticate');
    });

    Route::middleware('auth')->controller(LoginRegisterController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });


    Route::middleware(['auth', 'verified'])->controller(PosController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/addcustomer', 'addCustomer')->name('addcustomer');
        Route::get('/customerview', 'customerList')->name('customerList');
        Route::get('/addadmin', 'addAdmin')->name('addadmin');
        Route::get('/adminlist', 'adminList')->name('adminlist');
        Route::get('/addcategory', 'addCategory')->name('addcategory');
        Route::get('/categoryview', 'categoryList')->name('categoryList');
        Route::get('/editingcategory', 'editCategory')->name('editcategory');
        Route::get('/addingproducts', 'addProducts')->name('addproducts');
        Route::get('/productview', 'viewProducts')->name('productslist');
    });

    Route::fallback(function () {
    return response('Page not found', 404);
    });


    Route::get('/greeting', function () {
        return 'Hello World';
    });


    //verification
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    
    //Route::get('/registrar');


    



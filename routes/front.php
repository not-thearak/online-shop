<?php

use App\Http\Controllers\Front\CustomerAuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\SingleProductController;
use Illuminate\Support\Facades\Route;



//Customer Auth
Route::middleware('guest.customer')->group(function(){



    Route::get('/login',[CustomerAuthController::class,'loginShow'])->name('customer.login');
    Route::post('/login/process',[CustomerAuthController::class,'loginProcess'])->name('customer.login.process');
    Route::get('/register',[CustomerAuthController::class,'registerShow'])->name('customer.register');
    Route::post('/register/process',[CustomerAuthController::class,'registerProcess'])->name('customer.register.process');

    Route::get('/',[HomeController::class,'index'])->name('home.index');
    Route::get('/product/shop/{id}',[HomeController::class,'productCategory'])->name('product.category');
    Route::get('/product/view',[HomeController::class,'viewProduct'])->name('product.view');
    Route::get('/product/single/{id}',[SingleProductController::class,'singleProduct'])->name('product.single');
});

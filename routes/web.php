<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ColorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\DashboardMiddleware;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// Auth Router


// Route with prefix 'dashboard'
Route::group(['prefix' => 'admin'], function () {
    Route::get('/',[AuthController::class,'login'])->name('auth.index');
    Route::post('/login',[AuthController::class,'authenticate'])->name('auth.authenticate');

    // Middleware to protect routes
    Route::middleware(AuthMiddleware::class)->group(function(){
        //logout
        Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');

        // Dashboard Router
        Route::middleware(DashboardMiddleware::class)->group(function(){

            Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');

            // User Router
            Route::get('/user',[UserController::class,'index'])->name('user.index');
            Route::post('/user/list',[UserController::class,'list'])->name('user.list');
            Route::post('/user/store',[UserController::class,'store'])->name('user.store');
            Route::post('/user/destroy',[UserController::class,'destroy'])->name('user.destroy');
        });


        // Category Router
        Route::get('/category',[CategoryController::class,'index'])->name('category.index');
        Route::post('/category/list',[CategoryController::class,'list'])->name('category.list');
        Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
        Route::post('/category/upload',[CategoryController::class,'upload'])->name('category.upload');
        Route::post('/category/cancel',[CategoryController::class,'cancel'])->name('category.cancel');
        Route::post('/category/edit',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('/category/update',[CategoryController::class,'update'])->name('category.update');
        Route::post('/category/destroy',[CategoryController::class,'destroy'])->name('category.destroy');

        // Brand Router
        Route::get('/brand',[BrandController::class,'index'])->name('brand.index');
        Route::post('/brand/list',[BrandController::class,'list'])->name('brand.list');
        Route::post('/brand/store',[BrandController::class,'store'])->name('brand.store');
        Route::post('/brand/edit',[BrandController::class,'edit'])->name('brand.edit');
        Route::post('/brand/update',[BrandController::class,'update'])->name('brand.update');
        Route::post('/brand/destroy',[BrandController::class,'destroy'])->name('brand.destroy');

        // Color Router
        Route::get('/color',[ColorController::class,'index'])->name('color.index');
        Route::post('/color/list',[ColorController::class,'list'])->name('color.list');
        Route::post('/color/store',[ColorController::class,'store'])->name('color.store');
        Route::post('/color/edit',[ColorController::class,'edit'])->name('color.edit');
        Route::post('/color/update',[ColorController::class,'update'])->name('color.update');
        Route::post('/color/destroy',[ColorController::class,'destroy'])->name('color.destroy');

        // Product Router
        Route::get('/product',[ProductController::class,'index'])->name('product.index');
        Route::post('/product/list',[ProductController::class,'list'])->name('product.list');
        Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
        Route::post('/product/data',[ProductController::class,'data'])->name('product.data');
        Route::post('/product/edit',[ProductController::class,'edit'])->name('product.edit');
        Route::post('/product/update',[ProductController::class,'update'])->name('product.update');
        Route::post('/product/destroy',[ProductController::class,'destroy'])->name('product.destroy');

        // Image Router
        Route::post('/image/upload',[ImageController::class,'uploads'])->name('image.upload');
        Route::post('/image/cancel',[ImageController::class,'cancel'])->name('image.cancel');
    });


});



<?php

use App\Http\Controllers\User\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{product:slug}', [ProductController::class, 'show'])
    ->name('product.show');

Route::get('/category/{category}', [CategoryController::class, 'show'])
    ->name('product.category');


Route::get('/search', [SearchController::class, 'index'])
    ->name('search.index');

Route::get('/search/products', [SearchController::class, 'products'])
    ->name('search.products');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('product', AdminProductController::class);
    
});

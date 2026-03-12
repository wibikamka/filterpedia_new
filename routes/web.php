<?php

use App\Http\Controllers\User\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\User\BlogController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('product.category');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/products', [SearchController::class, 'products'])->name('search.products');
Route::get('/about', fn() => view('user.page.about'))->name('about');
Route::get('/terms', fn() => view('user.page.tos'))->name('tos');
Route::get('/privacy-policy', fn() => view('user.page.privacy-policy'))->name('privacy.policy');

// Admin routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::resource('product', AdminProductController::class);
    });

// ============================================
// AUTHENTICATED ROUTES - SATU GROUP SAJA
// ============================================
Route::middleware('auth')->group(function () {

    // Halaman account (semua device)
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');

    // DESKTOP ONLY - Ajax endpoints
    Route::middleware(['device.desktop'])->prefix('account')->name('account.')->group(function () {
        Route::patch('/update-name', [AccountController::class, 'updateName'])->name('update-name');
        Route::patch('/update-username', [AccountController::class, 'updateUsername'])->name('update-username');
        Route::patch('/update-bio', [AccountController::class, 'updateBio'])->name('update-bio');
        Route::patch('/update-email', [AccountController::class, 'updateEmail'])->name('update-email');
        Route::patch('/update-phone', [AccountController::class, 'updatePhone'])->name('update-phone');
        Route::post('/update-avatar', [AccountController::class, 'updateAvatar'])->name('update-avatar');
    });

    // MOBILE ONLY - Profile pages
    Route::middleware(['device.mobile'])->prefix('profile')->name('profile.')->group(function () {
        // Halaman index
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        
        // Edit pages
        Route::get('/edit-name', [ProfileController::class, 'editName'])->name('edit-name');
        Route::get('/edit-username', [ProfileController::class, 'editUsername'])->name('edit-username');
        Route::get('/edit-bio', [ProfileController::class, 'editBio'])->name('edit-bio');
        Route::get('/edit-email', [ProfileController::class, 'editEmail'])->name('edit-email');
        Route::get('/edit-phone', [ProfileController::class, 'editPhone'])->name('edit-phone');
        Route::get('/edit-avatar', [ProfileController::class, 'editAvatar'])->name('edit-avatar');
        
        // Update endpoints
        Route::patch('/update-name', [ProfileController::class, 'updateName'])->name('update-name');
        Route::patch('/update-username', [ProfileController::class, 'updateUsername'])->name('update-username');
        Route::patch('/update-bio', [ProfileController::class, 'updateBio'])->name('update-bio');
        Route::patch('/update-email', [ProfileController::class, 'updateEmail'])->name('update-email');
        Route::patch('/update-phone', [ProfileController::class, 'updatePhone'])->name('update-phone');
        Route::patch('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('update-avatar');
    });

    // CART ROUTES - Masih dalam group auth yang sama
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add/{product:slug}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    
    // Home route (kenapa ada /home sendiri?)
    Route::get('/home', fn() => view('user.page.home'))->name('home');
});

require __DIR__.'/auth.php';
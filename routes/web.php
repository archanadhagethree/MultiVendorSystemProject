<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Vendor\ProductController as VendorProductController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 1. CUSTOMER ROUTES (Shared & Personal)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('user.home');
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('user.cart.add');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('user.checkout');
    Route::delete('/cart/item/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('user.cart.remove');
    
    // Customer's personal order history
    Route::get('/my-orders', [OrderController::class, 'index'])->name('users.orders.index');
    Route::get('/my-orders/{id}', [OrderController::class, 'show'])->name('users.orders.show'); // Add this line
});

// 2. VENDOR ROUTES
Route::middleware(['auth', 'vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    
    Route::get('/orders', [VendorOrderController::class, 'index'])->name('orders.index');
    
    // PRODUCT ROUTES
    Route::get('/products', [VendorProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [VendorProductController::class, 'create'])->name('products.create');
    Route::post('/products', [VendorProductController::class, 'store'])->name('products.store');
    // Edit and Update
    Route::get('/products/{product}/edit', [VendorProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [VendorProductController::class, 'update'])->name('products.update');
    
    // Delete
    Route::delete('/products/{product}', [VendorProductController::class, 'destroy'])->name('products.destroy');
});

// 3. ADMIN ROUTES (Global Overlook)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Global Order Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
});

require __DIR__.'/auth.php';

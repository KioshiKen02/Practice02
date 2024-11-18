<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TransactionsController;


// Routes for admin-only access
Route::middleware('admin')->group(function () {
    Route::get('marketplace/create', [MarketplaceController::class, 'create'])->name('marketplace.create');
    Route::post('/marketplace/store', [MarketplaceController::class, 'store'])->name('marketplace.store');

    // Product management routes
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

// Marketplace Routes
Route::get('/marketdash', [MarketplaceController::class, 'index'])->name('marketdash');
Route::get('/marketplace/dashboard', [ProductController::class, 'index'])->name('marketplace.dashboard');

// Cart Routes
Route::post('/marketplace/index', [CartController::class, 'add'])->name('cart.add');
Route::get('/marketplace/show', [CartController::class, 'show'])->name('cart.show');
Route::get('/marketplace/show_pop', [CartController::class, 'showPop'])->name('cart.show.pop');

// Separate routes for update, delete, and checkout
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/delete/{itemId}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Routes requiring user authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/marketplace/preview', [CheckoutController::class, 'preview'])->name('checkout.preview');
    Route::post('/marketplace/preview', [CheckoutController::class, 'storeShippingInfo'])->name('checkout.storeShipping');
    Route::get('/checkout/complete', [CheckoutController::class, 'completeOrder'])->name('marketplace.complete');
});

Route::get('/marketplace/transaction/{referenceNumber}', [CheckoutController::class, 'transactionDetails'])
    ->name('marketplace.transactionDetails')
    ->middleware('auth');
    
Route::get('/transactions/details', [TransactionsController::class, 'index'])->name('transaction.details');
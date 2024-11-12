<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\CartController;

// Marketplace Routes
Route::get('/marketdash', [MarketplaceController::class, 'index'])->name('marketdash');
Route::get('marketplace/create', [MarketplaceController::class, 'create'])->name('marketplace.create');
Route::post('/marketplace/store', [MarketplaceController::class, 'store'])->name('marketplace.store');

// Cart Routes
Route::post('/marketplace/index', [CartController::class, 'add'])->name('cart.add');
Route::get('/marketplace/show', [CartController::class, 'show'])->name('cart.show');

// Separate routes for update, delete, and checkout
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

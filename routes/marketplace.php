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
Route::get('/marketplace/show_pop', [CartController::class, 'showPop'])->name('cart.show.pop');

// Separate routes for update, delete, and checkout
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/delete/{itemId}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

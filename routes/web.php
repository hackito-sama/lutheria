<?php

use Illuminate\Support\Facades\Route;

// --- PUBLICO ---
use App\Http\Controllers\IndexController;
Route::get('/', [IndexController::class, 'sliders'])->name('home');

use App\Http\Controllers\QuotationController;
Route::post('/contact', [QuotationController::class, 'store'])->name('contact.store');

use App\Http\Controllers\ProductController;
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

use App\Http\Controllers\CartController;
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');


use App\Http\Controllers\PaymentController;
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

use App\Http\Controllers\ConfiguratorController;
Route::get('/building/{id}', [ConfiguratorController::class, 'index'])->name('building-guitar.index');
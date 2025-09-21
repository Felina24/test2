<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;

Route::get('/register', [RegisterController::class, 'create'])->name('products.register');
Route::post('/register', [RegisterController::class, 'store'])->name('products.store');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::post('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

<?php

use Illuminate\Support\Facades\Route;

// Import controller product dan order
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController; // <--- PASTIKAN BARIS INI ADA DI SINI

// Route resource product
Route::resource('/products', ProductController::class);

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Rute manajemen data pesanan (CRUD)
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
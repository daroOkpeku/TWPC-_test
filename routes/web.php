<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Authentication routes
Auth::routes();

// Redirect authenticated users to products
Route::get('/', function () {
    return auth()->check() ? redirect()->route('products.index') : view('welcome');
})->name('welcome');

// Product routes (protected by authentication)
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

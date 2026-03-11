<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Authentication routes
Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'welcome'])->name('welcome')->middleware('check-auth');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/toggle-block', [AdminController::class, 'toggleBlockUser'])->name('users.toggle-block');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
     Route::get('/products/{product}', [AdminController::class, 'show'])->name('products.show');
    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('products.delete');
});


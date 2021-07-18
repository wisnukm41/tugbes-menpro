<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');
Route::get('/shop', [UserController::class, 'shop'])->name('shop');
Route::get('/shop/{type}', [UserController::class, 'shop'])->name('shop-type');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [UserController::class, 'chart'])->name('cart');
    Route::post('/chart', [UserController::class, 'add_chart'])->name('add-chart');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin-product');
    Route::get('/admin/product/add', [ProductController::class, 'create'])->name('admin-addProduct');
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin-storeProduct');
    Route::get('/admin/product/{id}', [ProductController::class, 'show'])->name('admin-showProduct');
    Route::get('/admin/product/{id}/edit', [ProductController::class, 'edit'])->name('admin-editProduct');
    Route::post('/admin/product/{id}/update', [ProductController::class, 'update'])->name('admin-updateProduct');
    Route::post('/admin/product/{id}/delete', [ProductController::class, 'destroy'])->name('admin-deleteProduct');

    Route::get('/admin/product/{id}/image', [ImageController::class, 'edit'])->name('admin-editImage');
    Route::post('/admin/product/{id}/image', [ImageController::class, 'update'])->name('admin-storeImage');
    Route::post('/admin/product/{id}/image-delete', [ImageController::class, 'destroy'])->name('admin-deleteImage');

    Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin-messages');
    Route::get('/admin/messages/{id}', [MessageController::class, 'show'])->name('admin-showMessages');
    Route::post('/admin/messages/{id}/delete', [MessageController::class, 'destroy'])->name('admin-deleteMessages');
    Route::post('/admin/messages/delete', [MessageController::class, 'destroy_read'])->name('admin-deleteReadMessages');
});

Route::get('/contact-us', [MessageController::class, 'create'])->name('user-messages');
Route::post('/contact-us', [MessageController::class, 'store'])->name('user-storeMessages');


require __DIR__ . '/auth.php';

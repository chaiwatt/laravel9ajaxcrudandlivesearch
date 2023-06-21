<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class,'products'])->name('products');
Route::post('/add-product', [ProductController::class,'addProduct'])->name('add.product');
Route::post('/update-product', [ProductController::class,'updateProduct'])->name('update.product');
Route::post('/products', [ProductController::class,'getProduct'])->name('get.product');
Route::get('/search-product', [ProductController::class,'searchProduct'])->name('search.product');
Route::delete('{id}', [ProductController::class,'delete'])->name('delete.product');
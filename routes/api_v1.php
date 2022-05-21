<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Accept: application/json 
 */




/**
 * Product Routes
 */
Route::get('/products', [\App\Http\Controllers\Api\V1\ProductController::class, 'index'])->name('product'); 
Route::get('/products/{id}', [\App\Http\Controllers\Api\V1\ProductController::class, 'show'])->name('product.show'); 


/**
 * Category Routes
 */
Route::get('/categories', [\App\Http\Controllers\Api\V1\CategoryController::class, 'index'])->name('categories');

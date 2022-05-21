<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Accept: application/json 
 */




/**
 * Product Routes
 */
Route::get('/product', [\App\Http\Controllers\Api\V1\ProductController::class, 'index'])->name('product'); 
Route::get('/product/{id}', [\App\Http\Controllers\Api\V1\ProductController::class, 'show'])->name('product.show'); 
<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\MainController::class, 'index']);
Route::get('/contact', [App\Http\Controllers\MainController::class, 'contact']);

Route::prefix('product')->name('product.')->group(function () {
    Route::get('/{id}-{slug?}.html', [App\Http\Controllers\ProductController::class, 'show'])->name('show');
});

Auth::routes();
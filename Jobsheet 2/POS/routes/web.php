<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return view('home', ['name' => 'Prasojo']);
});

use App\Http\Controllers\ProductController; 

Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [App\Http\Controllers\ProductController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductController::class, 'babyKid']);
});

use App\Http\Controllers\UserController;

Route::get('/{id}/name/{name}', [UserController::class, 'show']);

use App\Http\Controllers\SalesController;

Route::get('/sales', [SalesController::class, 'index']);
Route::post('/sales/process', [SalesController::class, 'process'])->name('sales.process');
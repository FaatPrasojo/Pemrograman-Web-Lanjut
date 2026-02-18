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

Route::get('/hello', function () { 
    return 'Hello World'; 
});

Route::get('/world', function() {
    return 'World';
});

Route::get('/', function() {
    return 'Selamat Datang';
});

Route::get('/about', function() {
    return 'Nama : Faatihurrizki Prasojo <br> NIM : 244107020142';
});

Route::get('/user/{name?}', function ($name=null) {
    return 'Nama saya '.$name; 
});

Route::redirect('/here', '/there');

Route::view('/welcome', 'welcome'); 
Route::view('/welcome', 'welcome', ['name' => 'Taylor']); 
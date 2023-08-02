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

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');

    Route::resource('posts', \App\Http\Controllers\PostController::class);
});

;

Route::inertia('about','About')->name('pages.about');

Route::inertia('login','Auth/Login')->name('login');

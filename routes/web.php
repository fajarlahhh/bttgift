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

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['active']], function () {
        Route::get('/', \App\Http\Livewire\Dashboard::class);
        Route::get('/dashboard', \App\Http\Livewire\Dashboard::class);
        Route::get('/profile', \App\Http\Livewire\Profile::class);
        Route::get('/withdrawal', \App\Http\Livewire\Withdraw::class);
    });
    Route::get('/activation', \App\Http\Livewire\Activation::class);
});

Route::get('/registration', \App\Http\Livewire\Registration::class);

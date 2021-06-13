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
    Route::group(['middleware' => ['member']], function () {
        Route::group(['middleware' => ['active']], function () {
            Route::get('/', \App\Http\Livewire\Member\Dashboard::class);
            Route::get('/dashboard', \App\Http\Livewire\Member\Dashboard::class);
            Route::get('/profile', \App\Http\Livewire\Member\Profile::class);
            Route::get('/withdrawal', \App\Http\Livewire\Member\Withdrawal::class);
            Route::get('/downline', \App\Http\Livewire\Member\Downline::class);
            Route::get('/gift', \App\Http\Livewire\Member\Gift::class);
            Route::get('/renewal', \App\Http\Livewire\Member\Renewal::class);
            Route::get('/achievement', \App\Http\Livewire\Member\Achievement::class);
            Route::get('/security', \App\Http\Livewire\Member\Security::class);
        });
        Route::group(['middleware' => ['inactive']], function () {
            Route::get('/activation', \App\Http\Livewire\Member\Activation::class);
        });
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::prefix('admin-area')->group(function (){
            Route::get('/', \App\Http\Livewire\Administrator\Dashboard::class);
            Route::get('/dashboard', \App\Http\Livewire\Administrator\Dashboard::class);
            Route::get('/deposit', \App\Http\Livewire\Administrator\Deposit::class);
            Route::get('/withdrawal', \App\Http\Livewire\Administrator\Withdrawal::class);
        });
    });
});

Route::get('/registration', \App\Http\Livewire\Registration::class);
Route::get('/forgot', \App\Http\Livewire\Forgot::class);
Route::get('/recovery', \App\Http\Livewire\Recovery::class);

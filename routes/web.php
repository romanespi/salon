<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('package', App\Http\Controllers\PackageController::class);
Route::resource('role', App\Http\Controllers\RoleController::class)->middleware('auth');
Route::resource('user', App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('event', App\Http\Controllers\EventController::class)->middleware('auth');
Route::resource('photo', App\Http\Controllers\PhotoController::class)->middleware('auth');

    Route::resource('cost', App\Http\Controllers\CostController::class)->middleware('auth');
    Route::resource('payment', App\Http\Controllers\PaymentController::class)->middleware('auth');





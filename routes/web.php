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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function() {
    Route::resource('/features', \App\Http\Controllers\FeatureController::class);
    Route::resource('/rooms', \App\Http\Controllers\RoomController::class);
    Route::resource('/photos', \App\Http\Controllers\PhotoController::class);
    Route::resource('/user', \App\Http\Controllers\UserController::class);
    Route::post('/user/upgradeAdmin', [\App\Http\Controllers\UserController::class, 'upgradeAdmin'])->name('user.upgradeAdmin');
});

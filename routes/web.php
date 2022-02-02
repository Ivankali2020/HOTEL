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

Route::get('/', [\App\Http\Controllers\WelcomeController::class,'index'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function() {
    Route::resource('/features', \App\Http\Controllers\FeatureController::class);
    Route::resource('/rooms', \App\Http\Controllers\RoomController::class);
    Route::resource('/photos', \App\Http\Controllers\PhotoController::class);
    Route::resource('/user', \App\Http\Controllers\UserController::class);
    Route::post('/booking/confirm',[\App\Http\Controllers\BookingController::class,'confirm'])->name('booking.confirm');
    Route::post('/user/upgradeAdmin', [\App\Http\Controllers\UserController::class, 'upgradeAdmin'])->name('user.upgradeAdmin');


    Route::resource('/booking_confirm', \App\Http\Controllers\ConfirmBookingController::class);
    Route::post('/booking_checkIn',[\App\Http\Controllers\ConfirmBookingController::class,'checkIn'])->name('confirm_booking.checkIn');
    Route::get('/booking_serving',[\App\Http\Controllers\ConfirmBookingController::class,'serving'])->name('confirm_booking.serving');

});


Route::resource('/booking', \App\Http\Controllers\BookingController::class);

Route::get('/redirect/{name}',[\App\Http\Controllers\Auth\LoginController::class,'redirect'])->name('redirect.name');
Route::get('/callback/{name}',[\App\Http\Controllers\Auth\LoginController::class,'callBack'])->name('callback.name');

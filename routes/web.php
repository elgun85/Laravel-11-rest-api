<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('test',[Api\ApiControlller::class,'index'])->name('test');

Route::get('apiPost',[Api\ApiControlller::class,'apiPost'])->name('apiPost');
Route::get('apiWeather',[Api\ApiControlller::class,'apiWeather'])->name('apiWeather');
Route::get('apiCat',[Api\ApiControlller::class,'apiCat'])->name('apiCat');

Route::get('apiUser',[UserController::class,'index'])->name('apiUser');

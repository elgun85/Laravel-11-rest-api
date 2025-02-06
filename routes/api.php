<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {


});


Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile']);
Route::apiResource('post', PostController::class);

Route::apiResource('products', ProductController::class);

Route::prefix('user')->group(function () {

Route::post('/createuser', [UserController::class,'createuser'])->name('createuser');
Route::post('/login', [UserController::class,'login'])->name('login');
Route::get('/logout', [UserController::class,'logout'])->name('logout');


});






Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

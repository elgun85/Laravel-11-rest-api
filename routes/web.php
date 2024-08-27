<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

Route::get('/', function () {
    return view('welcome');
});


Route::get('postApi',[Api\ApiControlller::class,'index'])->name('postApi');

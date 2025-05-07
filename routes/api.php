<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
     return $request->user();
    });

    Route::apiResource('books', BookController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

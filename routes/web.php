<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);          // GET /books
    Route::get('/{id}', [BookController::class, 'show']);       // GET /books/{id}
    Route::post('/', [BookController::class, 'store']);         // POST /books
    Route::put('/{id}', [BookController::class, 'update']);     // PUT /books/{id}
    Route::delete('/{id}', [BookController::class, 'destroy']); // DELETE /books/{id}
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);          // GET /books
    Route::get('/{id}', [ProductController::class, 'show']);       // GET /books/{id}
    Route::post('/', [ProductController::class, 'store']);         // POST /books
    Route::put('/{id}', [ProductController::class, 'update']);     // PUT /books/{id}
    Route::delete('/{id}', [ProductController::class, 'destroy']); // DELETE /books/{id}
});
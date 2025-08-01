<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Prefix 'books' berarti semua endpoint dimulai dari /api/books
Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);          // GET /api/books - Ambil semua buku
    Route::get('/{id}', [BookController::class, 'show']);       // GET /api/books/1 - Ambil buku berdasarkan ID
    Route::post('/', [BookController::class, 'store']);         // POST /api/books - Tambah buku baru
    Route::put('/{id}', [BookController::class, 'update']);     // PUT /api/books/1 - Perbarui buku
    Route::delete('/{id}', [BookController::class, 'destroy']); // DELETE /api/books/1 - Hapus buku
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);          // GET /books
    Route::get('/{id}', [ProductController::class, 'show']);       // GET /books/{id}
    Route::post('/', [ProductController::class, 'store']);         // POST /books
    Route::put('/{id}', [ProductController::class, 'update']);     // PUT /books/{id}
    Route::delete('/{id}', [ProductController::class, 'destroy']); // DELETE /books/{id}
});
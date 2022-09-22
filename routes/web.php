<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

    /**
     * @note
     * 
     *      index       GET/currencies
     *      create      GET/currencies/create
     *      store       POST/currencies
     *      show        GET/currencies/{id}
     *      edit        GET/currencies/{id}/edit
     *      update      PUT/currencies/{id}
     *      destroy     DELETE/currencies/{id}
     */

Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index']);
Route::get('/authors/{id}', [App\Http\Controllers\AuthorController::class, 'show']);
Route::get('/authors/create', [App\Http\Controllers\AuthorController::class, 'create']);
Route::get('/authors/{id}/edit', [App\Http\Controllers\AuthorController::class, 'edit']);
Route::post('/authors/store', [App\Http\Controllers\AuthorController::class, 'store']);
Route::put('/authors/update/{id}', [App\Http\Controllers\AuthorController::class, 'update']);
Route::delete('/authors/delete/{id}', [App\Http\Controllers\AuthorController::class, 'destroy']);

Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
Route::get('/books/{id}', [App\Http\Controllers\BookController::class, 'show']);
Route::get('/books/create', [App\Http\Controllers\BookController::class, 'create']);
Route::get('/books/{id}/edit', [App\Http\Controllers\BookController::class, 'edit']);
Route::post('/books/store', [App\Http\Controllers\BookController::class, 'store']);
Route::put('/books/update/{id}', [App\Http\Controllers\BookController::class, 'update']);
Route::delete('/books/delete/{id}', [App\Http\Controllers\BookController::class, 'destroy']);

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'show']);
Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create']);
Route::get('/categories/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::post('/categories/store', [App\Http\Controllers\CategoryController::class, 'store']);
Route::put('/categories/update/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::delete('/categories/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);


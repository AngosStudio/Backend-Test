<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('books', BookController::class);
    Route::apiResource('stores', StoreController::class);

    Route::post('stores/books', [BookStoreController::class, 'store']);
    Route::delete('stores/{store_id}/books/{book_id}', [BookStoreController::class, 'delete']);
    Route::get('stores/{id}/books', [BookStoreController::class, 'index']);
});

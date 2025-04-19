<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('get-books', [BookController::class, 'index']);
    Route::get('get-book-details/{book}', [BookController::class, 'show']);
    Route::post('store-book', [BookController::class, 'store']);
    Route::post('update-books/{book}', [BookController::class, 'update']);
    Route::post('books/{book}', [BookController::class, 'destroy']);

    Route::post('books/{book}/borrow', [BorrowController::class, 'borrow']);
    Route::post('books/{book}/return', [BorrowController::class, 'return']);
});
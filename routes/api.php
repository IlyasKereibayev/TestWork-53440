<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('books')->group(function() {
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{book}', [BookController::class, 'show']);
    Route::post('/', [BookController::class, 'store']);
    Route::put('/{book}', [BookController::class, 'update']);
    Route::delete('/{book}', [BookController::class, 'destroy']);
});


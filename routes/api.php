<?php

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

Route::post('/register', [\App\Http\Controllers\Api\RegisterController::class, 'store']);
Route::post('/login', [\App\Http\Controllers\Api\LoginController::class, 'store']);

Route::middleware('auth:sanctum')->post('/logout',
    [\App\Http\Controllers\Api\LogoutController::class, 'logout']);

Route::post([\App\Http\Controllers\Api\RegisterController::class, 'register'])->middleware('guest');
Route::post([\App\Http\Controllers\Api\LoginController::class, 'login'])->middleware('guest');

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\UserController::class, 'show']);
    Route::patch('/', [\App\Http\Controllers\Api\UserController::class, 'update']);
});

Route::group(['prefix' => 'films'], function () {
    Route::get('/', [\App\Http\Controllers\Api\FilmController::class, 'index']);                      // Все пользователи
    Route::patch('/{id}', [\App\Http\Controllers\Api\FilmController::class, 'show']);                 // Все пользователи
    Route::get('/{id}/similar', [\App\Http\Controllers\Api\FilmController::class, 'getSimilar'])      // Все пользователи
    ->where('id', '\d+');
    Route::get('/{id}/comments', [\App\Http\Controllers\Api\CommentController::class, 'show'])        // Все пользователи
    ->where('id', '\d+');
});

Route::prefix('films')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [\App\Http\Controllers\Api\FilmController::class, 'store']);                     // Модератор
    Route::patch('/{id}', [\App\Http\Controllers\Api\FilmController::class, 'update'])                // Модератор
        ->where('id', '\d+');
    Route::post('/{id}/favorite', [\App\Http\Controllers\Api\FavoriteController::class, 'store'])
        ->where('id', '\d+');
    Route::delete('/{id}/favorite', [\App\Http\Controllers\Api\FavoriteController::class, 'destroy'])
        ->where('id', '\d+');

    Route::post('/{id}/comments', [\App\Http\Controllers\Api\CommentController::class, 'store'])
        ->where('id', '\d+');
});

Route::get('genres/', [\App\Http\Controllers\Api\GenreController::class, 'index']);                   // Все пользователи

Route::prefix('genres')->middleware('auth:sanctum')->group(function () {
    Route::patch('/{genre}', [\App\Http\Controllers\Api\GenreController::class, 'update']);           // Модератор
});

Route::middleware('auth:sanctum')->get('/favorite', [\App\Http\Controllers\Api\FavoriteController::class, 'index']);

Route::prefix('comments')->middleware('auth:sanctum')->group(function () {
    Route::patch('/{comment}', [\App\Http\Controllers\Api\CommentController::class, 'update']);
    Route::delete('/{comment}', [\App\Http\Controllers\Api\CommentController::class, 'destroy']);
});

Route::prefix('promo')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\PromoController::class, 'index']);
    Route::post('/{id}', [\App\Http\Controllers\Api\PromoController::class, 'store'])                // Модератор
        ->where('id', '\d+');
});

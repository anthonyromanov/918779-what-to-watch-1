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

Route::middleware('auth:sanctum')->post('/logout',
    [\App\Http\Controllers\LogoutController::class, 'logout']);

Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->middleware('guest');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->middleware('guest');

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'show']);
    Route::patch('/', [\App\Http\Controllers\UserController::class, 'update']);
});

Route::group(['prefix' => 'films'], function () {
    Route::get('/', [\App\Http\Controllers\FilmController::class, 'index'])->name('films.index');                      // Все пользователи
    Route::get('/{film}', [\App\Http\Controllers\FilmController::class, 'show'])->name('films.show');                // Все пользователи
    Route::get('/{id}/similar', [\App\Http\Controllers\FilmController::class, 'getSimilar'])                           // Все пользователи
    ->where('id', '\d+');
    Route::get('/{film}/comments', [\App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
    Route::get('/{id}/comments', [\App\Http\Controllers\CommentController::class, 'show'])                             // Все пользователи
    ->where('id', '\d+');
});

Route::prefix('films')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [\App\Http\Controllers\FilmController::class, 'store'])->name('films.store');                     // Модератор
    Route::patch('/{id}', [\App\Http\Controllers\FilmController::class, 'update'])                // Модератор
        ->where('id', '\d+');
    Route::post('/{id}/favorite', [\App\Http\Controllers\FavoriteController::class, 'store'])
        ->where('id', '\d+');
    Route::delete('/{id}/favorite', [\App\Http\Controllers\FavoriteController::class, 'destroy'])
        ->where('id', '\d+');

    Route::post('/{film}/comments/{comment?}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store')
        ->where('id', '\d+');
});

Route::get('genres/', [\App\Http\Controllers\GenreController::class, 'index'])->name('genres.index');                   // Все пользователи

Route::prefix('genres')->middleware('auth:sanctum')->group(function () {
    Route::patch('/{genre}', [\App\Http\Controllers\GenreController::class, 'update'])->name('genres.update');           // Модератор
});

Route::middleware('auth:sanctum')->get('/favorite', [\App\Http\Controllers\FavoriteController::class, 'index']);

Route::prefix('comments')->middleware('auth:sanctum')->group(function () {
    Route::patch('/{comment}', [\App\Http\Controllers\CommentController::class, 'update']);
    Route::delete('/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->middleware('can:moderator')->name('comments.destroy');
});

Route::prefix('promo')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [\App\Http\Controllers\PromoController::class, 'index']);
    Route::post('/{id}', [\App\Http\Controllers\PromoController::class, 'store'])                // Модератор
        ->where('id', '\d+');
});

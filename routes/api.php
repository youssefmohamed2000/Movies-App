<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MovieController;
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

// AUTH
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

//GENRES
Route::get('genres', [GenreController::class, 'index']);

//MOVIES
Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/{id}/images', [MovieController::class, 'images']);
Route::get('movies/{id}/actors', [MovieController::class, 'actors']);
Route::get('movies/{id}/related', [MovieController::class, 'relatedMovies']);

Route::middleware('auth:sanctum')->group(function () {

    //MOVIES
    Route::post('movies/{id}/toggle-favourite', [MovieController::class, 'toggleFavourite']);
    Route::get('movies/favourite-list' , [MovieController::class , 'favouriteList']);

    //USER
    Route::get('user', [AuthController::class, 'user']);

});

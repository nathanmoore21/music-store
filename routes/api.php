<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ArtistController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

//each route inside the {} will require auth
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user', [AuthController::class, 'user']);

    //will need to be logged in for all functionality other than get all and get by id
    Route::apiResource('/musics', MusicController::class)->except((['index', 'show']));
    Route::apiResource('/artists', ArtistController::class)->except((['index', 'show']));
    Route::apiResource('/genres', GenreController::class)->except((['index', 'show']));
});

// Route::get('/musics', [MusicController::class, 'index']);
// Route::get('/musics/{music}', [MusicController::class, 'show']);

//routes to musics, artists, genres with CRUD functionality
Route::apiResource('/musics', MusicController::class)->only(['index', 'show']);
Route::resource('/artists', ArtistController::class)->only(['index', 'show']);;
Route::resource('/genres', GenreController::class)->only(['index', 'show']);;

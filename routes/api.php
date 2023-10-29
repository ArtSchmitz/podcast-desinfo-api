<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetVideosController;

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

Route::get('/podcast-desinfo', [GetVideosController::class, 'getVideosDesinfo']);

Route::get('/podcast-aderiva', [GetVideosController::class, 'getVideosAderiva']);

Route::get('/podcast-saco-cheio', [GetVideosController::class, 'getVideosSacoCheio']);

Route::get('/desinfo-info', [GetVideosController::class,'getVideosInfoDesinfo']);

Route::get('/aderiva-info', [GetVideosController::class,'getVideosInfoAderiva']);

Route::get('/saco-cheio-info', [GetVideosController::class,'getVideosInfoSacoCheio']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

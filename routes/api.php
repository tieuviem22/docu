<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ApiUserController;
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

Route::post('/upload/article',[ArticleController::class, 'store']);
// Route::get('/upload','ArticleController@store');

Route::post('/auth/register',[ApiUserController::class, 'Register']);
Route::post('/auth/login',[ApiUserController::class, 'Login']);
Route::get('/auth/infouser',[ApiUserController::class, 'userInfo']);
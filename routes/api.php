<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ManageController;
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
Route::get('/article',[ArticleController::class, 'GetArticle'])->middleware('auth:api');
Route::post('/upload/article',[ArticleController::class, 'store']);



//user
Route::get('/userInfo',[ApiUserController::class, 'userInfo'])->middleware('auth:api');

// Route::get('/upload','ArticleController@store');

Route::post('/auth/register',[ApiUserController::class, 'Register']);
Route::post('/auth/login',[ApiUserController::class, 'Login']);
Route::get('/auth/infouser',[ApiUserController::class, 'userInfo']);

//api select id name offer
Route::get('/select/offer', [ManageController::class, 'GetOffer']);


// manage vps api
Route::get('/manage/get', [ManageController::class, 'Test']);


Route::get('/manage/vps', [ManageController::class, 'GetVps'])->middleware('auth:api');
Route::post('/manage/vps', [ManageController::class, 'EditVps'])->middleware('auth:api');
Route::post('/manage/delete/vps', [ManageController::class, 'DeleteVps'])->middleware('auth:api');
Route::post('/manage/create/vps', [ManageController::class, 'CreateVps'])->middleware('auth:api');



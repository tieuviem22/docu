<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\IpqsController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\NetworkController;
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

// Route::get('/manage/get', [ManageController::class, 'Test']);

//user
Route::get('/userInfo',[ApiUserController::class, 'userInfo'])->middleware('auth:api');

// auth api;
Route::post('/auth/register',[ApiUserController::class, 'Register']);
Route::post('/auth/login',[ApiUserController::class, 'Login']);
Route::get('/auth/infouser',[ApiUserController::class, 'userInfo']);

//api select
Route::get('/select/offer', [ManageController::class, 'GetOffer']);
Route::get('/select/country', [ManageController::class, 'GetCountry']);
Route::get('/select/network', [ManageController::class, 'GetNetwork']);

// manage vps api
Route::get('/manage/vps', [ManageController::class, 'GetVps'])->middleware('auth:api');
Route::post('/manage/edit/vps', [ManageController::class, 'EditVps'])->middleware('auth:api');
Route::post('/manage/delete/vps', [ManageController::class, 'DeleteVps'])->middleware('auth:api');
Route::post('/manage/create/vps', [ManageController::class, 'CreateVps'])->middleware('auth:api');

// manage offer api

Route::get('/manage/offer/{status}', [OfferController::class, 'GetOffer']);
// Route::get('/manage/offer/active', [OfferController::class, 'GetOfferActive']);
// Route::get('/manage/offer/disabled', [OfferController::class, 'GetOfferDisabled']);
Route::post('/manage/create/offer', [OfferController::class, 'CreateOffer']);
Route::post('/manage/edit/offer', [OfferController::class, 'EditOffer']);
Route::post('/manage/delete/offer', [OfferController::class, 'DeleteOffer']);


// manage country api

Route::get('/manage/country', [CountryController::class, 'GetCountry']);
Route::post('/manage/create/country', [CountryController::class, 'CreateCountry']);
Route::post('/manage/edit/country', [CountryController::class, 'EditCountry']);
Route::post('/manage/delete/country', [CountryController::class, 'DeleteCountry']);


// manage ipqs api

Route::get('/manage/ipqs', [IpqsController::class, 'GetIpqs']);
Route::post('/manage/create/ipqs', [IpqsController::class, 'CreateIpqs']);
Route::post('/manage/edit/ipqs', [IpqsController::class, 'EditIpqs']);
Route::post('/manage/delete/ipqs', [IpqsController::class, 'DeleteIpqs']);


// manage conversion api

Route::get('/manage/conversion', [ConversionController::class, 'GetConversion']);
Route::post('/manage/create/conversion', [ConversionController::class, 'CreateConversion']);
Route::post('/manage/edit/conversion', [ConversionController::class, 'EditConversion']);
Route::post('/manage/delete/conversion', [ConversionController::class, 'DeleteConversion']);


// manage click api

Route::get('/manage/click/{time}', [ClickController::class, 'GetClick']);
Route::post('/manage/create/click', [ClickController::class, 'CreateClick']);
Route::post('/manage/edit/click', [ClickController::class, 'EditClick']);
Route::post('/manage/delete/click', [ClickController::class, 'DeleteClick']);

// manage network api

Route::get('/manage/network/{status}', [NetworkController::class, 'GetNetwork']);
Route::post('/manage/create/network', [NetworkController::class, 'CreateNetwork']);
Route::post('/manage/edit/network', [NetworkController::class, 'EditNetwork']);
Route::post('/manage/delete/network', [NetworkController::class, 'DeleteNetwork']);













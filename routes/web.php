<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoController;
use App\Http\Controllers\PbController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
});




// Route::name('/go')->group(function () {
Route::get('/go/offerid={offerid}&sub1={sub1}',[GoController::class, 'index']);
// });

Route::get('/pb/clickid={click_id}&payout={payout}',[PbController::class, 'index']);



<?php

use App\Http\Controllers\BookingApiController;
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

Route::get('/booking', [BookingApiController::class, 'time']);
Route::get('/date', [BookingApiController::class, 'date']);
// Route::get('/client', [BookingApiController::class, 'client']);

<?php

use App\Http\Controllers\PassengerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//---------ong---------------------
Route::get('/getPassengerDetailAPI/{email}', [PassengerController::class, 'getPassengerDetailAPI']);

Route::post('/createPassengerAPI', [PassengerController::class, 'createPassengerAPI']);

Route::post('/updatePassengerAPI/{passenger}', [PassengerController::class, 'updatePassengerAPI']);

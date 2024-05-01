<?php

use App\Http\Controllers\PassengerController;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\CustomPassengerVerificationRequest;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use Illuminate\Auth\Events\Verified;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PassengerController::class, 'list']);
Route::get('/edit/{id}', [PassengerController::class, 'edit']);
Route::put('/performEdit/{passenger}', [PassengerController::class, 'performEdit']);



Route::get('/email-verified/{id}', function ($id) {
    $passenger = Passenger::find($id);
    $passenger->markEmailAsVerified();
    event(new Verified($passenger));
    return view('emails.emailVerifySuccess');
});

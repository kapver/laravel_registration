<?php

use App\Http\Controllers\Api\CountryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegistrationApiController;

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

Route::group([
    'prefix' => 'auth',
    'as' => 'auth:',
], function () {
    Route::post('register', RegistrationApiController::class)->name('register');
});

Route::get('countries', [CountryApiController::class, 'index'])->name('countries');

Route::get('log_sms_welcome', function (Request $request) {
    Log::info('', ['data' => $request->toArray()]);
});
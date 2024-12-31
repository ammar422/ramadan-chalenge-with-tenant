<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Countries\App\Http\Controllers\Api\CityController;
use Modules\Countries\App\Http\Controllers\Api\CountryController;
use Modules\Countries\App\Http\Controllers\Api\UserCountry;

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

// Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
//     Route::get('countries', fn (Request $request) => $request->user())->name('countries');
// });

route::middleware('lang')->group(function () {

    Route::apiResource('countries', CountryController::class);
    Route::apiResource('cities', CityController::class);

});

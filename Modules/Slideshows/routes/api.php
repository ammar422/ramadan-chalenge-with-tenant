<?php

use Illuminate\Support\Facades\Route;
use Modules\SlideShows\App\Http\Controllers\Api\SlideShowController;

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
//     Route::get('slideshows', fn (Request $request) => $request->user())->name('slideshows');
// });

route::middleware('lang')->group(function () {

    Route::apiResource('slideshows', SlideShowController::class);
});

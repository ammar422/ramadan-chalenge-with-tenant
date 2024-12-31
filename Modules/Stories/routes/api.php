<?php

use Illuminate\Support\Facades\Route;
use Modules\Stories\App\Http\Controllers\Api\StoryController;

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

route::middleware('lang')->group(function () {

        Route::apiResource('stories', StoryController::class);
});

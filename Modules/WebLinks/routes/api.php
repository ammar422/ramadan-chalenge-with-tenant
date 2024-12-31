<?php

use Illuminate\Support\Facades\Route;
use Modules\WebLinks\App\Http\Controllers\Api\WeblinkController;

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
    route::apiResource('weblinks', WeblinkController::class);
});

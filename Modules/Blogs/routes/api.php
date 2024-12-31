<?php

use Illuminate\Support\Facades\Route;
use Modules\Blogs\App\Http\Controllers\Api\BlogsApiController;



Route::middleware('lang')->group(function () {
    Route::apiResource('blogs', BlogsApiController::class)->only(['index', 'show']);
});

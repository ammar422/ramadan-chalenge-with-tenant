<?php

use Illuminate\Support\Facades\Route;
use Modules\Campaigns\App\Http\Controllers\Api\Auth\UserDonation;
use Modules\Campaigns\App\Http\Controllers\Api\Auth\UserCampaigns;
use Modules\Campaigns\App\Http\Controllers\Api\CampaignController;
use Modules\Campaigns\App\Http\Controllers\Api\DonationController;

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

    //campagins
    Route::apiResource('campaigns', CampaignController::class)->only(['index', 'show']);
    Route::apiResource('donations', DonationController::class)->only(['index', 'show', 'store']);
    Route::post('donations/callback', [DonationController::class, 'gateway_callback']);


    route::middleware(['auth:api', 'verified'])->group(function () {

        Route::apiResource('user/campaigns', UserCampaigns::class);
        Route::post('user/campaigns/{id}', [UserCampaigns::class, 'update']);

        Route::apiResource('user/donations', UserDonation::class);
        Route::post('user/donations/callback', [UserDonation::class, 'gateway_callback']);
    });
});

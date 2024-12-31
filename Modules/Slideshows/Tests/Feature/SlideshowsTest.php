<?php

namespace Modules\Slideshows\Tests\Feature;

use Modules\Countries\App\Models\Country;
use Modules\SlideShows\App\Models\SlideShow;
use Modules\Users\App\Models\User;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function createSlideShows($status = 'show', $count = 3, $account_type = 'admin')
{
    $countery = Country::factory()->create();
    $user = User::factory()->create(['account_type' => $account_type, 'country_id' => $countery->id]);
    SlideShow::factory()->count($count)->create(['status' => $status, 'user_id' => $user->id])->first();

    return SlideShow::where('status', $status)->first();
}

test('get all slideshows', function () {
    createSlideShows();
    $response = $this->getJson('api/v1/slideshows');
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('slideshows');

test('show slideshow', function () {
    $slideshow = createSlideShows();
    $response = $this->getJson("api/v1/slideshows/".$slideshow->id);
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($slideshow->id);
})->group('slideshows');

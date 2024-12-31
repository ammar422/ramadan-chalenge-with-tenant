<?php

namespace Modules\Videos\Tests\Feature;

use Modules\Users\App\Models\User;
use Modules\Videos\App\Models\Video;
use Modules\Countries\App\Models\Country;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function createVideos($status = 'show', $count = 3, $account_type = 'admin')
{
    $countery = Country::factory()->create();
    $user = User::factory()->create(['account_type' => $account_type, 'country_id' => $countery->id]);
    return Video::factory()->count($count)->create(['status' => $status, 'user_id' => $user->id])->first();
}

test('get all videos', function () {
    createVideos();
    $response = $this->getJson('api/v1/videos');
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('videos');

test('show video', function () {
    $video = createVideos();
    $response = $this->getJson("api/v1/videos/".$video->id);
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($video->id);
})->group('videos');

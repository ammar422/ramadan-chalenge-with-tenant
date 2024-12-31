<?php

namespace Modules\Stories\Tests\Feature;

use Modules\Stories\App\Models\Story;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function createStories($count = 3)
{
    return Story::factory()->count($count)->create()->first();
}

test('get all stories', function () {
    createStories(3);
    $response = $this->getJson('api/v1/stories');
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('stories');

test('show story', function () {
    $story = createStories(1);
    $response = $this->getJson("api/v1/stories/".$story->id);
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($story->id);
})->group('stories');

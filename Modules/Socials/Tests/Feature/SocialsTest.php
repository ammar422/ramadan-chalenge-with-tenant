<?php

namespace Modules\Socials\Tests\Feature;

use Modules\Socials\App\Models\Social;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function createSocials($count = 3)
{
    return Social::factory()->count($count)->create()->first();
}

test('get all socials', function () {
    createSocials(3);
    $response = $this->getJson('api/v1/socials');
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('socials');

test('show social', function () {
    $social = createSocials(1);
    $response = $this->getJson("api/v1/socials/" . $social->id);
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($social->id);
})->group('socials');

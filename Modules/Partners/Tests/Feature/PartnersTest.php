<?php

namespace Modules\Partner\Tests\Feature;

use Modules\Partners\App\Models\Partner;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function createPartners($status = 'show', $count = 3)
{
    Partner::factory()->count($count)->create(['status' => $status]);

    return Partner::where('status', $status)->first();
}

test('get all partners', function () {
    createPartners();
    $response = $this->getJson('api/v1/partners');
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('partners');

test('show partner', function () {
    $partner = createPartners();
    $response = $this->getJson("api/v1/partners/".$partner->id);
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($partner->id);
})->group('partners');

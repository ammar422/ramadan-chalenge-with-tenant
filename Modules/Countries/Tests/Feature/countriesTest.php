<?php

namespace Modules\Countries\Tests\Feature;

use Modules\Countries\App\Models\Country;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

test('list all countries', function () {
    Country::factory()->count(5)->create();
    $response = $this->getJson('api/v1/countries');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('countries');


test('list cities of a specific country', function () {
    $country = Country::factory()
        ->hasCities(5)
        ->create();

    $response = $this->getJson("api/v1/cities?country_id={$country->id}");

    $response->assertStatus(200);
    $data = $response->json()['result']['data'];
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
    foreach ($data as $city) {
        expect($city['country']['id'])->toBe($country->id);
    }
})->group('cities');


test('cannot list cities without country_id', function () {
    $response = $this->getJson('api/v1/cities');

    $response->assertStatus(400);
    expect($response->json()['message'])->toBe('need country id');
})->group('cities');
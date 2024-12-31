<?php

namespace Modules\Categories\Tests\Feature;

use Modules\Categories\App\Models\Category;

uses(
    \Tests\TestCase::class,
    // Uncomment the line below if you need database refresh
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

test('list categories', function () {
    Category::factory()->count(5)->create();
    $response = $this->getJson('api/v1/categories');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result')->toBeGreaterThan(0);
})->group('categories');

test('show a single categories', function () {
    $category = Category::factory()->create();
    
    $response = $this->getJson("api/v1/categories/{$category->id}");

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($category->id);  
})->group('categories');

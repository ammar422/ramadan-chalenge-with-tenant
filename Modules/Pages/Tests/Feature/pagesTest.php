<?php

namespace Modules\Pages\Tests\Feature;

use Modules\Pages\App\Models\Page;

uses(
    \Tests\TestCase::class,
    // Uncomment the line below if you need database refresh
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function createPages($status = 'show', $count = 3)
{
    Page::factory()->count($count)->create(['status' => $status]);

    return Page::where('status', $status)->first();
}

test('list all pages', function () {
    createPages();

    $response = $this->getJson('api/v1/pages');
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('pages');

test('show a single page', function () {
    $page = createPages();
    $response = $this->getJson("api/v1/pages/{$page->id}");
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($page->id);
})->group('pages');

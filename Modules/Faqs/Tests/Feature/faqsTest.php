<?php

namespace Modules\Faqs\Tests\Feature;

use Modules\Faqs\App\Models\Faq;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

test('list all FAQs', function () {
    Faq::factory()->count(5)->create();
    $response = $this->getJson('api/v1/faqs');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('faqs');

test('show a single FAQ', function () {
    $faq = Faq::factory()->create();
    $response = $this->getJson("api/v1/faqs/{$faq->id}");

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($faq->id);    
})->group('faqs');

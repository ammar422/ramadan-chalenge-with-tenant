<?php

namespace Modules\WebLinks\Tests\Feature;

use Modules\Countries\App\Models\Country;
use Modules\Users\App\Models\User;
use Modules\WebLinks\App\Models\Weblink;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(
    \Tests\TestCase::class,
    RefreshDatabase::class,
);

function creatWebLinks($place = 'header', $status = 'show')
{
    Country::factory()->create();
    User::factory()->create(['account_type' => 'admin']);
    Weblink::factory()->count(3)->create(['place' => $place, 'status' => $status]);
    return Weblink::where('place', $place)->where('status', $status)->first();
}


test('list all weblinks in header', function () {
    creatWebLinks('header', 'show');
    $response = $this->getJson('api/v1/weblinks?place=header');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('weblinks');

test('list all weblinks in footer', function () {
    creatWebLinks('footer', 'show');
    $response = $this->getJson('api/v1/weblinks?place=footer');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('weblinks');

test('list all weblinks without place parameter', function () {
    $response = $this->getJson('api/v1/weblinks');

    $response->assertStatus(403);
    expect($response->json()['message'])->toBe('plcae must in header or footer');
})->group('weblinks');

test('show a single weblink', function () {
    $weblink = creatWebLinks('header', 'show');
    $response = $this->getJson("api/v1/weblinks/{$weblink->id}");

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($weblink->id);  
})->group('weblinks');

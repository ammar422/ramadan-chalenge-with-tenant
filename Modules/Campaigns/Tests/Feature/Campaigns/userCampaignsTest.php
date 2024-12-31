<?php

namespace Modules\Campaigns\Tests\Feature\Campaigns;

use Modules\Campaigns\App\Models\Campaign;
use Modules\Categories\App\Models\Category;
use Modules\Countries\App\Models\Country;
use Modules\Users\App\Models\User;

uses(
    \Tests\TestCase::class,
    // Uncomment the line below if you need database refresh
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function setupData($account_type ='user', $createCampaigns = false, $isPublic = 'yes')
{
    $currency = Country::factory()->create();
    $category = Category::factory()->create();
    $user = User::factory()->create([
        'account_type' => $account_type,
        'country_id'   => $currency->id
    ]);

    $campaigns = $createCampaigns
        ? Campaign::factory()->count(5)->create([
            'is_public' => $isPublic,
            'user_id' => $user->id,
            'currency_id' => $currency->id,
        ])
        : collect();

    $campaign = $campaigns->first();

    return [$category, $currency, $user, $campaign];
}


test('list user campaigns', function () {
    setupData('user', true, 'yes');
    
    $token = testUser()['token'];

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson('api/v1/user/campaigns');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('user-campaigns');

test('create a new campaign', function () {
    $token = testUser()['token'];
    [$category, $currency, $user, $campaign] = setupData('user', false);

    $payload = [
        'name:en'       => 'Test Campaign EN',
        'content:en'    => 'Content for campaign EN',
        'name:ar'       => 'Test Campaign AR',
        'content:ar'    => 'Content for campaign AR',
        'image'         =>  \Illuminate\Http\UploadedFile::fake()->image('test.jpg'),
        'video_url'     => 'https://example.com/video',
        'start_at'      => now()->format('Y-m-d H:i:s'),
        'end_at'        => now()->addDays(10)->format('Y-m-d H:i:s'),
        'total_days'    => 10,
        'is_public'     => 'yes',
        'currency_id'   => $currency->id,
        'sort'          => 1,
        'status'        => 'pending',
        'price_target'  => 1000.50,
        'category_id'   => $category->id,
    ];

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('api/v1/user/campaigns', $payload);

    $response->assertStatus(200);
    expect($response->json('result.id'))->not->toBeNull();
})->group('user-campaigns');

test('update a campaign', function () {
    $token = testUser()['token'];
    [$category, $currency, $user, $campaign] = setupData('user', true);

    $payload = [
        'name:en'       => 'Updated Campaign EN',
        'content:en'    => 'Updated content EN',
        'name:ar'       => 'Test Campaign AR',
        'content:ar'    => 'Content for campaign AR',
        'image'         =>  \Illuminate\Http\UploadedFile::fake()->image('test.jpg'),
        'video_url'     => 'https://example.com/video',
        'start_at'      => now()->format('Y-m-d H:i:s'),
        'end_at'        => now()->addDays(10)->format('Y-m-d H:i:s'),
        'total_days'    => 10,
        'is_public'     => 'yes',
        'currency_id'   => $currency->id,
        'sort'          => 1,
        'status'        => 'pending',
        'price_target'  => 1000.50,
        'category_id'   => $category->id,
    ];

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson("api/v1/user/campaigns/{$campaign->id}", $payload);

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id');
})->group('user-campaigns');

test('view campaign details', function () {
    $token = testUser()['token'];

    [$category, $currency, $user, $campaign] = setupData('user', true);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson("api/v1/user/campaigns/{$campaign->id}");

    $response->assertStatus(200);
    expect($response->json('result.id'))->toBe($campaign->id);
})->group('user-campaigns');


test('delete a campaign', function () {
    $token = testUser()['token'];

    [$category, $currency, $user, $campaign] = setupData('user', true);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->deleteJson("api/v1/user/campaigns/{$campaign->id}");

    $response->assertStatus(200);
})->group('user-campaigns');

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

function createCampaigns($account_type ='admin', $isPublic = 'yes')
{
    $country = Country::factory()->create();
    $category = Category::factory()->create();
    $user = User::factory()->create(['account_type' => $account_type, 'country_id' => $country->id]);
    Campaign::factory()->count(5)->create(['is_public' => $isPublic, 'user_id' => $user->id, 'category_id' => $category->id]);
    return Campaign::where('is_public', $isPublic)->first();
}

test('list all campaigns', function () {
    createCampaigns('admin');
    $response = $this->getJson('api/v1/campaigns');
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('campaigns');

test('list public campaigns', function () {
    createCampaigns('admin', 'yes');
    $response = $this->getJson('api/v1/campaigns?is_public=yes');
    $response->assertStatus(200);
    foreach ($response->json()['result']['data'] as $campaign) {
        expect($campaign['is_public'])->toBe('yes');
    }
})->group('campaigns');


test('list unpublic campaigns', function () {
    createCampaigns('admin', 'no');
    $response = $this->getJson('api/v1/campaigns?is_public=no');

    $response->assertStatus(200);
    foreach ($response->json()['result']['data'] as $campaign) {
        expect($campaign['is_public'])->toBe('no');
    }
})->group('campaigns');


test('validate is_public query parameter', function () {
    $response = $this->getJson('api/v1/campaigns?is_public=invalid');

    $response->assertStatus(422);
    expect($response->json()['message'])->toBe('when call is public please use yes or no');
})->group('campaigns');

test('show a single campaign', function () {
    $campaign = createCampaigns('admin', 'yes');
    $response = $this->getJson("api/v1/campaigns/".$campaign->id);

    $response->assertStatus(200);
    expect($response->json()['result']['id'])->toBe($campaign->id);
})->group('campaigns');

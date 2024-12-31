<?php

namespace Modules\Campaigns\Tests\Feature\Donations;

use Modules\Campaigns\App\Models\Campaign;
use Modules\Campaigns\App\Models\Donation;
use Modules\Categories\App\Models\Category;
use Modules\Countries\App\Models\Country;
use Modules\Users\App\Models\User;

uses(
    \Tests\TestCase::class,
    // Uncomment the line below if you need database refresh
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function createDonations($type='admin',int $donationCount = 0)
{
    $country = Country::factory()->create();
    $category =  Category::factory()->create();
    $user = User::factory()->create(['account_type' => $type]);
    $campaign = Campaign::factory()
        ->hasDonations($donationCount)
        ->create(['user_id' => $user->id, 'currency_id' => $country->id, 'category_id' => $category->id]);

    return [$country, $campaign];
}

test('create a new donation', function () {
    [$country, $campaign] = createDonations('user');
    $response = $this->postJson('api/v1/donations', [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'mobile' => '1234567890',
        'love_donation' => 'no',
        'ongoing_charity' => 'yes',
        'amount' => 100,
        'charity_amount' => 50,
        'currency_id' => $country->id,
        'campaign_id' => $campaign->id,
    ]);

    $response->assertStatus(200);
    $data = $response->json();
    expect($data)->toHaveKey('result.id');
})->group('donations');

test('list donations of a specific campaign', function () {
    [$country, $campaign] = createDonations(2);
    $response = $this->getJson("api/v1/donations?campaign_id={$campaign->id}");

    $response->assertStatus(200);
    $data = $response->json()['result']['data'];
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
    foreach ($data as $donation) {
        expect($donation['campaign']['id'])->toBe($campaign->id);
    }
})->group('donations');

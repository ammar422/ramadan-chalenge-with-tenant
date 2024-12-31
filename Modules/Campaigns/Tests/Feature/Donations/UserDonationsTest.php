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

function createUserDonations($account_type='admin', int $donationCount = 0)
{
    $country = Country::factory()->create();
    $category = Category::factory()->create();
    $user = User::factory()->create(['account_type' => $account_type, 'country_id' => $country->id]);
    $campaign = Campaign::factory()
        ->hasDonations($donationCount, ['email' => $user->email])
        ->create([
            'user_id' => $user->id,
            'currency_id' => $country->id,
            'category_id' => $category->id,
        ]);

    return [$country, $campaign, $campaign->donations, $user];
}

test('list user donations', function () {
    createUserDonations('user', 3);
    $token = testUser()['token'];

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson('api/v1/user/donations');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('user-donations');


test('view donation details', function () {
    [$country, $campaign, $donations, $user] = createUserDonations('user', 1);
    $donation = $donations->first();
    $token = testUser()['token'];

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson("api/v1/user/donations/{$donation->id}");

    $response->assertStatus(200);
    expect($response->json()['result']['id'])->toBe($donation->id);
})->group('user-donations');


test('create a new donation', function () {
    [$country, $campaign, $donations, $user] = createUserDonations('user');

    $token      = testUser()['token'];

    $payload = [
        'name'          => 'test',
        'email'         => $user['email'],
        'mobile'        => '1234567890',
        'love_donation' => 'no',
        'ongoing_charity' => 'yes',
        'amount' => 100,
        'charity_amount' => 50,
        'currency_id' => $country->id,
        'campaign_id' => $campaign->id,
    ];

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('api/v1/user/donations', $payload);

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id');
})->group('user-donations');

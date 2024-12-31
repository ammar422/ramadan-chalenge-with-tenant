<?php

namespace Modules\Blogs\Tests\Feature;

use Modules\Blogs\App\Models\Blog;
use Modules\Countries\App\Models\Country;
use Modules\Users\App\Models\User;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
);

function createBlogs($status = 'show', $account_type = 'admin')
{
    Country::factory()->create();
    $user = User::factory()->create(['account_type' => $account_type]);
    Blog::factory()->count(3)->create(['status' => $status, 'user_id' => $user->id]);
    return Blog::where('status', $status)->first();
}

test('list blogs', function () {
    createBlogs();
    $response = $this->getJson('api/v1/blogs');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.data')->toBeGreaterThan(0);
})->group('blogs');

test('show a single blog', function () {
    $blog = createBlogs('show');
    $response = $this->getJson(url('api/v1/blogs/' . $blog->id));
    
    $response->assertStatus(200);
    expect($response->json())->toHaveKey('result.id')->and($response->json()['result']['id'])->toBe($blog->id);    
})->group('blogs');

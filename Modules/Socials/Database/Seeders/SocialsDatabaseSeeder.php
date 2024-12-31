<?php

namespace Modules\Socials\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Socials\App\Models\Social;

class SocialsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Social::factory()->count(10)->create();
    }
}

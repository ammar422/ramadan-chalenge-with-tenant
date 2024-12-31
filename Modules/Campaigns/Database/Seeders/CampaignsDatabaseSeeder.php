<?php

namespace Modules\Campaigns\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Campaigns\App\Models\Campaign;
use Modules\Categories\App\Models\Category;

class CampaignsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Campaign::factory()->count(5)->hasUpdates(3)->hasDonations(5)->create();
    }
}

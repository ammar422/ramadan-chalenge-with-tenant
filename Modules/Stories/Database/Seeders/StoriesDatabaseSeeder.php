<?php

namespace Modules\Stories\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Stories\App\Models\Story;

class StoriesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Story::factory()->count(10)->create();
    }
}

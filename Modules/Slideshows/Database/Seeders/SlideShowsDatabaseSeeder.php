<?php

namespace Modules\SlideShows\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SlideShows\App\Models\SlideShow;

class SlideShowsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SlideShow::factory()
            ->count(10)
            ->create();
    }
}

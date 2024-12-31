<?php

namespace Modules\Videos\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Videos\App\Models\Video;

class VideosDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::factory()->count(10)->create();
    }
}

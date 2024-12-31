<?php

namespace Modules\Pages\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Pages\App\Models\Page;

class PagesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::factory(5)->create();
    }
}

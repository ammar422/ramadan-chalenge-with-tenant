<?php

namespace Modules\WebLinks\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\WebLinks\App\Models\Weblink;

class WebLinksDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //    Weblink::factory()->count(5)->hasWeblinks(3)->create();
        Weblink::factory()
            ->count(5)
            ->has(Weblink::factory()->count(3), 'weblinks')
            ->create();
    }
}

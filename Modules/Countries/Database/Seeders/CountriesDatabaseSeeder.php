<?php

namespace Modules\Countries\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Countries\App\Models\Country;

class CountriesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Country::factory()
            ->count(5)
            ->hasCities(5)
            ->create();
    }
}

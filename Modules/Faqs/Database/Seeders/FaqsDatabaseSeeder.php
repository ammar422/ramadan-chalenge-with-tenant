<?php

namespace Modules\Faqs\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Faqs\App\Models\Faq;

class FaqsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::factory()->count(10)->create();
    }
}

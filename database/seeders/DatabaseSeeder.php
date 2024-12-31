<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //strat modules seeders
            // \Modules\Countries\Database\Seeders\CountriesDatabaseSeeder::class,
            // \Modules\Users\Database\Seeders\UsersDatabaseSeeder::class,
            // \Modules\Categories\Database\Seeders\CategoriesDatabaseSeeder::class,
            // \Modules\Blogs\Database\Seeders\BlogsDatabaseSeeder::class,
            // \Modules\Campaigns\Database\Seeders\CampaignsDatabaseSeeder::class,
            // \Modules\Pages\Database\Seeders\PagesDatabaseSeeder::class,
            // \Modules\SlideShows\Database\Seeders\SlideShowsDatabaseSeeder::class,
            // \Modules\Stories\Database\Seeders\StoriesDatabaseSeeder::class,
            // \Modules\Partners\Database\Seeders\PartnersDatabaseSeeder::class,
            // \Modules\Faqs\Database\Seeders\FaqsDatabaseSeeder::class,
            // \Modules\Stories\Database\Seeders\StoriesDatabaseSeeder::class,
            // \Modules\Videos\Database\Seeders\VideosDatabaseSeeder::class,
            // \Modules\WebLinks\Database\Seeders\WebLinksDatabaseSeeder::class,
            // \Modules\Socials\Database\Seeders\SocialsDatabaseSeeder::class,
            //end modules seeders
        ]);

        Setting::factory()->create();
    }
}

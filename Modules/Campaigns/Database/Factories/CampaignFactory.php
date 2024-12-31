<?php

namespace Modules\Campaigns\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Categories\App\Models\Category;
use Modules\Countries\App\Models\Country;
use Modules\Users\App\Models\User;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Campaigns\App\Models\Campaign::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar' => ['name' =>  $fkr->name,     'content'       => $fkr->paragraph()],
            'en' => ['name' =>  $fkr_en->name,  'content'    => $fkr_en->paragraph()],

            'user_id'           => User::inRandomOrder()->first()->id,
            'sort'              => $fkr->randomNumber(1, 100),
            'image'             => $fkr->imageUrl(),
            'price_target'      => $fkr->randomFloat(2, 1, 1000),
            'start_at'          => now(),
            'end_at'            => now()->addDays($fkr->numberBetween(1, 30)),
            'video_url'         => $fkr->url(),
            'total_donors'      => $fkr->numberBetween(0, 100),
            'total_amount'      => $fkr->randomFloat(2, 1, 1000),
            'status'            => $fkr->randomElement(['pending', 'published', 'ended', 'completed', 'cancelled']),
            'is_public'         => $fkr->randomElement(['yes', 'no']),
            'currency_id'       => Country::inRandomOrder()->first()->id,
            'category_id'       => Category::inRandomOrder()->first()->id,
        ];
    }
}

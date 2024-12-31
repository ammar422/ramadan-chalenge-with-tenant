<?php

namespace Modules\Campaigns\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignUpdateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Campaigns\App\Models\CampaignUpdate::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar'        => ['title' => $fkr->title(), 'content'   => $fkr->title()],
            'en'        => ['title' => $fkr_en->title(), 'content'   => $fkr->title()],
            'image'     => $fkr->imageUrl(),
            'status'    => $fkr->randomElement(['hide', 'show']),
            'user_id'   => User::inRandomOrder()->first()->id
        ];
    }
}

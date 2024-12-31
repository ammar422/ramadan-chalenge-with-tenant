<?php

namespace Modules\Videos\Database\Factories;

use Modules\Users\App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Videos\App\Models\Video::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar'        => ['title' => $fkr->name()],
            'en'        => ['title' => $fkr_en->name()],
            'video_url' => $fkr->url,
            'status'    => $fkr->randomElement(['show', 'hide']),
            'user_id'   => User::inRandomOrder()->first()?->id,
        ];
    }
}

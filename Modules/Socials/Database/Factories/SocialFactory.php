<?php

namespace Modules\Socials\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Socials\App\Models\Social;

class SocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Social::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr('en');
        return [
            'name' => $fkr->word,
            'url' => $fkr->url,
            'icon' => $fkr->imageUrl(),
        ];
    }
}


<?php

namespace Modules\SlideShows\Database\Factories;

use Modules\Users\App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlideShowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\SlideShows\App\Models\SlideShow::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr    = fkr();
        $fkr_en = fkr('en');

        $type = $fkr->randomElement(['image', 'video']);
        return [
            'ar'            => ['title' => $fkr->name(),    'content' => $fkr->text(300),    'url_title' => $fkr->title()],
            'en'            => ['title' => $fkr_en->name(), 'content' => $fkr_en->text(300), 'url_title' => $fkr->title()],
            'slide_type'    => $type,
            'image'         => $type == 'image' ? $fkr->imageUrl() : null,
            'video'         => $type == 'video' ? $fkr->url() : null,
            'status'        => $fkr->randomElement(['show', 'hide']),
            'user_id'       => User::inRandomOrder()->first()->id,
            'url'           =>  $fkr->url(),
        ];
    }
}

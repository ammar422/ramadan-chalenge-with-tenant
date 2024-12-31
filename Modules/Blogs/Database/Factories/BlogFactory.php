<?php

namespace Modules\Blogs\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Users\App\Models\User;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Blogs\App\Models\Blog::class;

    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar' => ['title' => $fkr->name(),    'description'   => $fkr->text(300),    'content'   => $fkr->text(300)],
            'en' => ['title' => $fkr_en->name(), 'description'   => $fkr_en->text(300), 'content'   => $fkr_en->text(300)],
            'image'          => $fkr->imageUrl(),
            'video'          => $fkr->url(),
            'status'         => $fkr->randomElement(['show', 'hide']),
            'user_id'        => User::inRandomOrder()->first()->id
        ];
    }
}

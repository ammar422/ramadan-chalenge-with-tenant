<?php

namespace Modules\Stories\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Stories\App\Models\Story::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar'    => ['title' =>  $fkr->title, 'content'       => $fkr->paragraph()],
            'en'    => ['title' =>  $fkr_en->title, 'content'    => $fkr_en->paragraph()],
            'image' => $fkr->imageUrl(),
        ];
    }
}

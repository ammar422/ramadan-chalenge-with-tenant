<?php

namespace Modules\Pages\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Pages\App\Models\Page::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'status'    => $fkr->randomElement(['show', 'hide']),
            'ar'        => ['name' => $fkr->name(),     'content' => $fkr->paragraphs(3, true)],
            'en'        => ['name' => $fkr_en->name(), 'content' => $fkr_en->paragraphs(3, true)],
        ];
    }
}

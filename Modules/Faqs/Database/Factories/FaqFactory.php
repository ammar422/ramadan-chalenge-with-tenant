<?php

namespace Modules\Faqs\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Faqs\App\Models\Faq::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar' => ['title' =>  $fkr->name,    'content'    => $fkr->paragraph()],
            'en' => ['title' =>  $fkr_en->name, 'content' => $fkr_en->paragraph()],

            
        ];
    }
}

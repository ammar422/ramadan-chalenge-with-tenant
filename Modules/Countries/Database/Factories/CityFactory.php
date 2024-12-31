<?php

namespace Modules\Countries\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Countries\App\Models\City::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar' => ['name' => $fkr->country()],
            'en' => ['name' => $fkr_en->country()],
        ];
    }
}

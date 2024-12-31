<?php

namespace Modules\Partners\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Partners\App\Models\Partner::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar'            => ['name' =>  $fkr->name],
            'en'            => ['name' =>  $fkr_en->name],
            'image'         => $fkr->imageUrl(),
            'status'        => $fkr->randomElement(['show', 'hide']),
        ];
    }
}

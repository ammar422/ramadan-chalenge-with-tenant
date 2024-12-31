<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fkr = fkr();
        return [

            'site_name'        => $fkr->word(),
            'description'      => $fkr->sentence(),
            'keywords'         => $fkr->word(),
            'logo'             => $fkr->imageUrl(),
            'icon'             => $fkr->imageUrl(),
            'maintenance_mode' => $fkr->randomElement(['on', 'off']),
        ];
    }
}

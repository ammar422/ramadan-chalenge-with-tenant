<?php

namespace Modules\Countries\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Countries\App\Models\City;

class CountryFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Countries\App\Models\Country::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar'                => ['name' => $fkr->country(), 'currency_name' => $fkr->currencyCode()],
            'en'                => ['name' => $fkr_en->country(), 'currency_name' => $fkr_en->currencyCode()],
            'iso'               => $fkr->countryCode(),
            'currency_symbol'   => $fkr->currencyCode(),
            'currency_rate'     => '1.00',
            'mob_code'          => rand(2, 9),
            'show_in_campaign'  => $fkr->randomElement(['yes' , 'no']),
        ];
    }


    /**
     * Define a relationship for cities.
     *
     * @param int $count
     * @return $this
     */
    public function hasCities(int $count)
    {
        return $this->has(
            City::factory()->count($count),
            'cities'
        );
    }
}

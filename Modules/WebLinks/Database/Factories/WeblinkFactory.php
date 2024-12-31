<?php

namespace Modules\WebLinks\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Users\App\Models\User;

class WeblinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\WebLinks\App\Models\Weblink::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar'        => ['name' => $fkr->name()],
            'en'        => ['name' => $fkr_en->name()],
            'place'     => $fkr->randomElement(['header', 'footer']),
            'status'    => $fkr->randomElement(['show', 'hide']),
            'user_id'   => User::inRandomOrder()->first()->id,
            'url'       =>  $fkr->url(),
        ];
    }
}

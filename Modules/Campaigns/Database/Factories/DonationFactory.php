<?php

namespace Modules\Campaigns\Database\Factories;

use Modules\Users\App\Models\User;
use Modules\Countries\App\Models\Country;
use Modules\Campaigns\App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Campaigns\App\Models\Donation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $fkr = fkr('en');
        return [
            'name' => $fkr->name,
            'email' => $fkr->email,
            'mobile' => $fkr->phoneNumber,
            'love_donation' => $fkr->randomElement(['yes', 'no']),
            'love_name' => $fkr->name,
            'love_email' => $fkr->email,
            'love_mobile' => $fkr->phoneNumber,
            'love_comment' => $fkr->text,
            'amount' => $fkr->randomFloat(2, 0, 100),
            'total_amount' => $fkr->randomFloat(2, 0, 100),
            'ongoing_charity' => $fkr->randomElement(['yes', 'no']),
            'charity_amount' => $fkr->randomFloat(2, 0, 100),
            'currency_id' => Country::inRandomOrder()->first()->id,
            'usd_rate' => $fkr->randomFloat(2, 0, 100),
            'total_usd' => $fkr->randomFloat(2, 0, 100),
            'myr_rate' => $fkr->randomFloat(2, 0, 100),
            'total_myr' => $fkr->randomFloat(2, 0, 100),
            'gateway' => $fkr->randomElement(['PayPal',  'Bank Transfer']),
            'transaction_json' => $fkr->text(200),
            'status' => $fkr->randomElement(['pending', 'done', 'cancelled', 'rejected']),
        ];
    }
}
